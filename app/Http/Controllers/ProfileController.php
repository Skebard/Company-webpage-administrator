<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class ProfileController extends Controller
{
    //

    public function __construct()
    {
        //check if user is logged in or not
        $this->middleware('auth');
    }
    public function changePassword()
    {
        return view('admin.profile.change_password');
    }
    public function updatePassword(Request $request)
    {
        $validateData = $request->validate(
            [
                'current_password' => 'required',
                'password' => 'required|confirmed',
            ],
            []
        );

        $hashedPassword = Auth::user()->password;
        if (password_verify($request->current_password, $hashedPassword)) {
            // $user = User::find(Auth::id());
            // $user->password = password_hash($request->password,PASSWORD_BCRYPT);
            // $user->save();

            User::find(Auth::id())->update([
                'password' => password_hash($request->password, PASSWORD_BCRYPT),
            ]);
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Password Changed Successfully');
        } else {
            $message = ['error', 'Current Password Is Invalid'];
            return Redirect()->back()->with(...$message);
        }
        //Auth::logout();

    }

    public function editProfile()
    {
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.profile.edit',compact('user'));
            }
        }
    }
    public function updateProfile(Request $request){
        $validateData = $request->validate([
            'name' => ['unique:users,name,'.Auth::id(),'required','min:8'],
            'email' => 'required|email',
        ]);


        $user = User::find(Auth::id());
        if($user){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('storage/profile-photos/',$name_gen);
            unlink('storage/'.$user->profile_photo_path);
            $user->profile_photo_path = 'profile-photos/'.$name_gen;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return Redirect()->back()->with('success','Profile Updated Successfully');
        }else{
            return Redirect()->back()->with('error','Profile Updated Successfully');
        }
    }
}
