<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    // admin list
    public function list (){
        $userData = User::get();
        return view ('admin.List.adminList',compact('userData'));
    }

    // admin account delete
    public function accountDelete ($id){
        User::where('id',$id)->delete();

        return back()->with(["DeleteSuccess" => 'Success Delete Admin Account']);
    }
}
