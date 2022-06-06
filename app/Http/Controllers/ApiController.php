<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function getData()
    {
        return User::all();
    }

    public function storeData(Request $request, User $user)
    {
        $user->name = $request->name; 
        $user->email = $request->email;
        $user->password = $request->password;
        $user->picture = $request->picture;
        $result = $user->save();

        if($result) {
            return "Data insert Successfully";
        } else {
            return "Fail to data insert";
        }
    }

    public function updateData(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->picture = $request->picture;
        $result = $user->save();

        if($result) {
            return "Record update Successfully";
        } else {
            return "Fail to record update";
        }
    }

    public function deleteData($id)
    {
        $user = User::find($id);
        $result = $user->delete();

        if($result) {
            return "Record Delete Successfully";
        } else {
            return "Fail to delete record";
        }
    }

    public function searchData($name)
    {
        return User::where('name', "like", "%" .$name. "%")->get();
    }
}
