<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserListController extends Controller
{
    public function userListPage($role){

        $list = User::where('role',$role)->paginate(7);
        return view('admin/userList/list')->with(['list' => $list,'role' => $role]);
    }

    public function userDelete(Request $request){
        // logger($request->id);
        //get old image name
        $oldImage = User::where('id', $request->id)->select('image')->first()->image;
        //delete old image
        if($oldImage != null){
            Storage::delete('public/books/' . $oldImage);
        }
        User::where('id', $request->id)->delete();
    }

    public function userRole(Request $request){
        User::where('id',$request->id)->update(['role' =>$request->role]);
    }

    public function userDetail($id){
        $user = User::where('id',$id)->first();
        return view('admin/userList/detail')->with(['user' => $user]);
    }
}
