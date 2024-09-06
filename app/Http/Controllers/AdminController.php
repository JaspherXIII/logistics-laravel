<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $inventories = Inventory::all();

        $inStockCount = 0;
        $lowStockCount = 0;
        $outOfStockCount = 0;

        foreach ($inventories as $inventory) {
            if ($inventory->quantity > 10) {
                $inStockCount++;
            } elseif ($inventory->quantity > 0 && $inventory->quantity <= 10) {
                $lowStockCount++;
            } else {
                $outOfStockCount++;
            }
        }

        $timezone = 'Asia/Manila';
        $currentTime = new \DateTime('now', new \DateTimeZone($timezone));
        $hour = (int) $currentTime->format('H');

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }

        $topProductsQuery = Inventory::with('product')
            ->orderBy('quantity', 'desc')
            ->take(5);

        if ($request->has('filter')) {
            $filter = $request->input('filter');
            switch ($filter) {
                case 'Year':
                    $topProductsQuery->whereYear('created_at', now()->year);
                    break;
                case 'Month':
                    $topProductsQuery->whereMonth('created_at', now()->month);
                    break;
                case 'Week':
                    $topProductsQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
            }
        }

        $topProducts = $topProductsQuery->get();

        return view('dashboards.admins.index', compact('inStockCount', 'lowStockCount', 'outOfStockCount', 'greeting', 'topProducts'));
    }




    public function profile()
    {
        return view('dashboards.admins.profile');
    }

    public function student()
    {
        return view('dashboards.admins.students');
    }



    public function settings()
    {
        return view('dashboards.admins.settings');
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
        $file = $request->file('admin_image');
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
