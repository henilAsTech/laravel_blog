<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Blog;

class AdminController extends Controller
{
    // admni controller for blog
    public function index()
    {
        return view('admin/login');
    }

    public function dashboard(User $user, Blog $blog)
    {
        $total_user = $user->where('id', '>=', 1)->get()->count();
        $total_blog = $blog->where('id', '>=', 1)->get()->count();

        return view('admin.dashboard', compact('total_user', 'total_blog'));
    }

    public function blogList(Request $request, Blog $blog)
    {
        $blogs =  $blog->where([
            ['id', '>=', 1],
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('title', 'LIKE', '%' . $search . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('admin.bloglist', compact('blogs'))
            ->with('i', (request()->input('page', 1) - 1) * 3);
    }

    public function showBlog(Blog $blog, $id)
    {
        $blogs = $blog->find($id);
        return view('admin.showblog', compact('blogs'));
    }

    public function blogCreate()
    {
        return view('admin.createblog');
    }

    public function blogStore(Request $request, Blog $blog)
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

        $blog->title = $request->title;
        $blog->type = $request->type;
        $blog->description = $request->description;
        $blog->picture = $last_img;
        $blog->user_id = auth()->user()->id;
        $blog->save();

        return redirect('admin/blogcreate');
    }

    public function blogEdit(Blog $blog, $id)
    {
        $blogs = $blog->find($id);
        return view('admin/editblog', compact('blogs'));
    }

    public function blogUpdate(Request $request, Blog $blog)
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
        return redirect(route('bloglist'));
    }

    public function blogDestroy(Request $request, Blog $blog, $id)
    {
        $id = $blog->find($id);
        $image = $blog->picture;

        if ($image) {
            unlink($image);
        }

        $id->delete();
        return redirect(route('bloglist'));
    }

    // admin controller for user
    public function userList(Request $request, User $user)
    {
        $users =  $user->where([
            ['id', '>=', 1],
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('title', 'LIKE', '%' . $search . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('admin.userlist', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 3);
    }

    public function userCreate()
    {
        return view('admin.createuser');
    }

    public function userStore(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'picture' => 'required | image | mimes:jpg,jpeg,png,jfif,gif | max:20480'
        ]);

        $msg = $request->input('name');
        $request->session()->flash('name', $msg);

        $blog_image = $request->file('picture');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($blog_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $up_location = 'image/user/';
        $last_img = $up_location . $img_name;
        $blog_image->move($up_location, $img_name);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->picture = $last_img;
        $user->save();

        return redirect(route('usercreate'));
    }

    public function showUser(User $users, $id)
    {
        $user = $users->find($id);
        return view('admin.showuser', compact('user'));
    }

    public function userEdit(User $user, $id)
    {
        $users = $user->find($id);
        return view('admin.edituser', compact('users'));
    }

    public function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $old_image = $request->old_picture;
        $user_image = $request->file('picture');

        if ($user_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($user_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/user/';
            $last_img = $up_location . $img_name;
            $user_image->move($up_location, $img_name);

            unlink($old_image);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'picture' => $last_img,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        $user->find($request->user_id);
        return view('admin.showuser', compact('user'));
    }

    public function userDestroy(Request $request, User $user, $id)
    {
        $users = $user->find($id);
        $image = $user->picture;

        if ($image) {
            unlink($image);
        }

        $users->delete();
        return redirect(route('userlist'));
    }
}
