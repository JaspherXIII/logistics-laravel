<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class AccountController extends Controller
{   
    
    public function getAccounts(): JsonResponse
    {
        $users = User::orderBy('id')->get();


        return response()->json(['data' => $users]);
    }

    public function index(Request $request)
    {
        return view('dashboards.admins.accounts.index');
    }

    public function show(string $id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $users = User::find($id)->delete();
        return response()->json(['success' => 'User Account Deleted Successfully!']);
    }

    public function getTrashedAccounts(): JsonResponse
    {
        $users = User::onlyTrashed()->orderBy('id')->get();

        return response()->json(['data' => $users]);
    }

    public function trashed(Request $request)
    {
        return view('dashboards.admins.accounts.trashed');
    }

    public function restore(string $id)
    {
        User::whereId($id)->restore();
        return response()->json(['success' => 'User Account Restored Successfully!']);
    }

    public function forceDelete(string $id)
    {
        User::whereId($id)->forceDelete();
        return response()->json(['success' => 'User Account Deleted Successfully!']);
    }
}
