<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile(Request $request, $id)
    {
        $user = User::find($id);
        return view('user.userprofile', compact('user'));
    }

    public function editProfile(Request $request, $id)
    {
        $user = User::find($id);
        return view('user.editprofile', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
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

            if ($old_image) {
                unlink($old_image);
            }

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


        return redirect('/profile/' . $request->user_id);
    }

    public function destroyProfile(User $user, $id)
    {
        $users = $user->find($id);
        $image = $user->picture;

        if ($image) {
            unlink($image);
        }

        $users->delete();
        return view('home');
    }
}
