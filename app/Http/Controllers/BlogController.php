<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Blog::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('title', 'LIKE', '%' . $search . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'desc')
            ->paginate(2);

        return view('blog.view', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'picture' => 'required | image | mimes:jpg,jpeg,png,jfif,gif | max:20480'
        ]);

        $msg = $request->input('title');
        $request->session()->flash('title', $msg);

        $blog_image = $request->file('picture');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($blog_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $up_location = 'image/blog/';
        $last_img = $up_location . $img_name;
        $blog_image->move($up_location, $img_name);


        $blog = new Blog();
        $blog->title = $request->title;
        $blog->type = $request->type;
        $blog->description = $request->description;
        $blog->picture = $last_img;
        $blog->user_id = auth()->user()->id;
        $blog->save();

        return redirect('blog/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Blog::find($id);
        return view('blog.singleView', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Blog::find($id);
        return view('blog.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $msg = $request->input('title');
        $request->session()->flash('title', $msg);

        $old_image = $request->old_picture;

        $blog_image = $request->file('picture');

        if ($blog_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($blog_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/blog/';
            $last_img = $up_location . $img_name;
            $blog_image->move($up_location, $img_name);

            unlink($old_image);

            $blog->update([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
                'picture' => $last_img,
            ]);
        } else {
            $blog->update([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
            ]);
        }
        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $blog = Blog::find($id);
        $image = $blog->picture;

        if ($image) {
            unlink($image);
        }

        $blog->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Product deleted successfully');
    }
}
