<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class ProfileController extends Controller
{
    //

    public function __construct(){
        //check if user is logged in or not
        $this->middleware('auth');
    }
    public function changePassword(){
        return view('admin.profile.change_password');
    }
    public function updatePassword(Request $request){
        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ],
        [

        ]);

        $hashedPassword = Auth::user()->password;
        if(password_verify($request->current_password,$hashedPassword)){
            // $user = User::find(Auth::id());
            // $user->password = password_hash($request->password,PASSWORD_BCRYPT);
            // $user->save();
            
            User::find(Auth::id())->update([
                'password' => password_hash($request->password,PASSWORD_BCRYPT),
            ]);
            Auth::logout();
            return Redirect()->route('login')->with('success','Password Changed Successfully');
        }else{
            $message = ['error','Current Password Is Invalid'];
            return Redirect()->back()->with(...$message);
        }
        //Auth::logout();
        
    }
}
