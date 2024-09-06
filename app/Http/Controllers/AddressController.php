<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        Address::updateOrCreate(
            ['id' => $request->address_id],
            [
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address
            ]
        );
        return response()->json(['success' => 'Address  Added Successfully!']);
    }

    public function show($id)
    {
        $address = Address::find($id);

        if ($address) {
            return response()->json($address);
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        if ($address) {
            $address->update($request->all());
            return response()->json($address);
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
}
