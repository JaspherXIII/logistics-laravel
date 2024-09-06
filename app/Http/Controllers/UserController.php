<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {


        return view('dashboards.users.orders');
    }


    public function profile()
    {
        $user = Auth::user();
        dd($user->student);
        return view('dashboards.users.profile', compact('courses'));
    }


    public function settings()
    {
        return view('dashboards.users.settings');
    }

    public function updateInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if (!$query) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile info has been updated successfully.']);
            }
        }
    }


    public function updatePicture(Request $request)
    {
        $path = 'users/images/';
        $file = $request->file('user_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        } else {
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if ($oldPicture != '') {
                if (File::exists(public_path($path . $oldPicture))) {
                    File::delete(public_path($path . $oldPicture));
                }
            }

            $update = User::find(Auth::user()->id)->update(['picture' => $new_name]);

            if (!$upload) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture failed.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile has been updated successfully.']);
            }
        }
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpassword' => 'required|min:8|max:30',
            'cnewpassword' => 'required|same:newpassword'
        ], [
            'oldpassword.required' => 'Enter your current password',
            'oldpassword.min' => 'Old password must have atleast 8 characters',
            'oldpassword.max' => 'Old password must not greater than 30 characters',
            'newpassword.required' => 'Enter new password',
            'newpassword.min' => 'New password must have atleast 8 characters',
            'newpassword.max' => 'New password must not greater than 30 characters',
            'cnewpassword.required' => 'Re-enter your new password',
            'cnewpassword.same' => 'New password and Confirm new password must match',
        ]);


        if (!$validator->passes()) {

            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $update = User::find(Auth::user()->id)->update(['password' => Hash::make($request->newpassword)]);

            if (!$update) {

                return response()->json(['status' => 0, 'msg' => 'Something went wrong, failed to update password.']);
            } else {

                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully.']);
            }
        }
    }
}
