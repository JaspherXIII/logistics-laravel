<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{   
    public function getSupplierDetails(Request $request)
    {
        $supplier = Supplier::find($request->id);

        if ($supplier) {
            return response()->json([
                'address' => $supplier->address,
                'email' => $supplier->email,
                'phone_number' => $supplier->phone_number
            ]);
        } else {
            return response()->json(['error' => 'Supplier not found'], 404);
        }
    }
    
    public function getSuppliers(): JsonResponse
    {
        $suppliers = Supplier::orderBy('id')->get();
        return response()->json(['data' => $suppliers]);
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.suppliers');

            } elseif ($user->role === 2) {
                return view('dashboards.users.suppliers');

            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    public function store(Request $request)
    {
        Supplier::updateOrCreate(
            ['id' => $request->supplier_id],
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'status' => $request->status,
            ]
        );
        return response()->json(['success' => 'Supplier  Added Successfully!']);
    }

    public function edit(string $id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Supplier not found'], 404);
        }

        if ($supplier->subjects()->exists()) {
            return response()->json(['error' => 'Supplier has associated subjects, cannot be deleted'], 422);
        }

        $supplier->delete();

        return response()->json(['success' => 'Supplier Deleted Successfully!']);
    }
}
