<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UserProfile;
use App\User;
use Brian2694\Toastr\Facades\Toastr;

class UsersController extends Controller
{
    public function userList()
    {
        return view('admin.user.users', [
            'users' => User::where('role', '!=', 'admin')->latest()->get()
        ]);
    }

    public function userApprove($id)
    {
        $user = User::find($id);
        $user->is_approved = 1;
        $user->save();

        Toastr::success('User Approved Successfully', 'Approve');
        return redirect()->route('admin.users');
    }

    public function userDetails($id)
    {
        return view('admin.user.user-details', [
            'user' => User::find($id)
        ]);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        if (isset($user->profile->photo)) {
            if (file_exists($user->profile->photo)) {
                unlink($user->profile->photo);
            }
        }
        $user->delete();

        Toastr::success('User Deleted Successfully', 'Delete');
        return redirect()->route('admin.users');
    }

}
