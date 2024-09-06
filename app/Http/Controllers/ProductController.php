<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(): JsonResponse
    {
        $products = Product::with('supplier')->orderBy('id')->get();
        return response()->json(['data' => $products]);
    }

    public function getProductsBySupplier($supplierId)
    {
        $products = Product::where('supplier_id', $supplierId)->get();
        return response()->json($products);
    }

    

    public function index(Request $request)
    {
        $suppliers = Supplier::all();

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.products', compact('suppliers'));

            } elseif ($user->role === 2) {
                return view('dashboards.users.products', compact('suppliers'));

            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
       
    }

    public function store(Request $request)
    {
        $imgPath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('businesses/images'), $imageName);
            $imgPath = 'businesses/images/' . $imageName;
        }

        Product::updateOrCreate(
            ['id' => $request->product_id],
            [
                'name' => $request->name,
                'category' => $request->category,
                'unit' => $request->unit,
                'image' => $imgPath,
                'price' => $request->price,
                'supplier_id' => $request->supplier,
                'status' => 'Active',
            ]
        );

        return response()->json(['success' => 'Product Added Successfully!']);
    }


    public function edit(string $id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function updateTable(Request $request)
    {
        $products = $request->products;

        foreach ($products as $productData) {
            $product = Product::find($productData['id']);
            $product->name = $productData['name'];
            $product->category = $productData['category'];
            $product->unit = $productData['unit'];
            $product->price = $productData['price'];
            $product->status = $productData['status']; // Update status
            $product->save();
        }

        return response()->json(['success' => 'Products Updated Successfully!']);
    }
}
