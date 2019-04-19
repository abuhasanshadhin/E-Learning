<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\UserProfile;

class ProfileController extends Controller
{
    public function instructorProfile($id)
    {
        return view('instructor.profile.profile', [
            'user' => User::find(Auth::id()),
            'profile' => UserProfile::firstOrCreate(['user_id' => Auth::id()])
        ]);
    }

    public function profile()
    {
        return view('user.profile.profile', [
            'user' => User::find(Auth::id()),
            'profile' => UserProfile::firstOrCreate(['user_id' => Auth::id()])
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'mimes:jpg,png,jpeg|max:2048',
            'phone' => 'max:15'
        ]);

        $user = User::find(Auth::id());
        $user->update($request->all());

        $profileData = $request->except(['_token', 'name', 'email']);
        if (isset($request->photo)) {
            if (file_exists($user->profile->photo)) {
                unlink($user->profile->photo);
            }
            $uploadedImagePath = imageUpload($request, 'photo', 'uploads');
            $profileData['photo'] = $uploadedImagePath;
        }
        $user->profile()->update($profileData);

        if (Auth::user()->role == 'instructor') {
            return redirect()->route('instructor.profile', Auth::id())
            ->with('message', 'Your profile updated successfully');
        } else {
            return redirect()->route('user.profile')
                ->with('message', 'Your profile updated successfully');
        }
        
    }

    public function changePasswordForm()
    {
        return view('user.password.change-password');
    }

    public function instructorChangePasswordForm()
    {
        return view('instructor.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|required_with:confirm_new_password|same:confirm_new_password',
            'confirm_new_password' => 'min:6'
        ]);

        $user_password = User::find(Auth::id())->password;
        
        if (password_verify($request->old_password, $user_password)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->confirm_new_password);
            $user->save();
            return redirect()->back()->with('message', 'Your password successfully changed');
        } else {
            return redirect()->back()->with('error-message', 'Your old password was incorrect');
        }
    }

}
