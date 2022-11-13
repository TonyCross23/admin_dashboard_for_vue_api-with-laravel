<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // direct home page
    public function home (){
        return view ('admin.profile.index');
    }

    // direct profile Page
    public function profilePage (){
        $userId = User::where('id',Auth::user()->id)->first();
        return view ('admin.profile.index',compact('userId'));
    }

    // profile change
    public function profileChange (Request $request) {
        $userData = $this->userGetData($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::where('id', Auth::user()->id )->update($userData);


    return back()->with(['Success'=>"Update Success!"]);
    }

    // change password page
    public function changePasswordPage (Request $request){
        return view ('admin.profile.passwordChange');
    }

    // change Password
    public function changePassword (Request $request){
        $validator = $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;

        if(Hash::check($request->oldPassword,$dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];

            User::where('id',Auth::user()->id)->update($data);

            return redirect()->route('admin#profilePage');
        }

        return back()->with(["notMath" => 'The Old Password Do Not Match , Try Again!']);

    }



    // password validation check
    private function passwordValidationCheck ($request){

          return Validator::make($request->all(), [
                'oldPassword' => 'required',
                'newPassword' => 'required',
                'confirmPassword' => 'required|same:newPassword',
            ])->validate();
    }

    // user data
    private function userGetData ($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ];
    }


}
