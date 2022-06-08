<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // log out users
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'You just logged out.',
            'alert-type' => 'info',
        );

        return redirect('/login')->with($notification);
    }

    // view user profile
    public function profile()
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);

        return view('admin.admin_profile_view', ['adminData' => $userData]);
    }

    // edit user profile form
    public function editProfile()
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);

        return view('admin.admin_profile_edit', ['adminData' => $userData]);
    }

    // update user profile with image or without image
    public function storeProfile(Request $request)
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);

        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->username = $request->username;

        // I think this works fine for Laravel 8
        // if($request->hasFile('profile_image')) {
        //     $path = $request->file('profile_image')->store('public/profileImages');

        //     if($userData->profile_image) {
        //         Storage::delete($userData->profile_image);
        //         $userData->profile_image = $path;
        //     } else {
        //         $userData['profile_image'] = $path;
        //     }
        // }
        
        // upload image for Laravel 9
        if($request->hasFile('profile_image')) {
            if($userData->profile_image) {
                File::delete(public_path('upload/profile_images/'.$userData->profile_image));
                $file = $request->file('profile_image');
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/profile_images'), $fileName);
                $userData['profile_image'] = $fileName;
            } else {
                $file = $request->file('profile_image');
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/profile_images'), $fileName);
                $userData['profile_image'] = $fileName;
            }
        }

        $userData->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword() {
        return view('admin.admin_change_password');
    }

    public function updatePassword(Request $request) {
        $validateDate = $request->validate([
            'old_password' => 'required', 
            'new_password' => 'required', 
            'confirm_password' => 'required|same:new_password', 
        ]);

        // check for the password inside the database
        $hashed_password = Auth::user()->password;

        // check if the password user provides matches the password in the database
        if(Hash::check($request->old_password, $hashed_password)) {
            $users = User::findOrFail(Auth::id()); // get the current user id
            $users->password = bcrypt($request->new_password); // encrypt and  assign the password provided by user into the database 
            $users->save();

            session()->flash('message','Password Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('message','Old password is not match');
            return redirect()->back();
        }
    }
}
