<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function getProductsByinventory($productId)
    {
        $inventories = Inventory::where('product_id', $productId)->get();
        return response()->json($inventories);
    }


    public function getInventories(Request $request): JsonResponse
    {
        $query = Inventory::with('product.supplier')->orderBy('id');

        if ($request->filled('category')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('category', $request->category);
            });
        }

        if ($request->filled('stock_status')) {
            $query->where(function ($q) use ($request) {
                if ($request->stock_status == 'Out of Stock') {
                    $q->where('quantity', 0);
                } elseif ($request->stock_status == 'Low In Stock') {
                    $q->where('quantity', '>', 0)->where('quantity', '<', 10);
                } elseif ($request->stock_status == 'In Stock') {
                    $q->where('quantity', '>=', 10);
                }
            });
        }

        if ($request->filled('item_status')) {
            $query->where('status', $request->item_status);
        }

        $inventories = $query->get();

        $categories = $inventories->pluck('product.category')->unique()->values();
        $statuses = $inventories->pluck('status')->unique()->values();
        $stockStatuses = $inventories->map(function ($item) {
            if ($item->quantity === 0) {
                return 'Out of Stock';
            } elseif ($item->quantity < 10) {
                return 'Low In Stock';
            } else {
                return 'In Stock';
            }
        })->unique()->values();

        return response()->json([
            'data' => $inventories,
            'categories' => $categories,
            'statuses' => $statuses,
            'stockStatuses' => $stockStatuses,
        ]);
    }


    public function index(Request $request)
    {
        $products = Product::all();
       

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.inventories', compact('products'));
            } elseif ($user->role === 2) {
                return view('dashboards.users.inventories', compact('products'));
            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    public function store(Request $request)
    {

        Inventory::updateOrCreate(
            ['id' => $request->inventory_id],
            [
                'price' => $request->price,
                'status' => $request->status,
            ]
        );

        return response()->json(['success' => 'Inventory Edited Successfully!']);
    }

    public function edit(string $id)
    {
        $inventory = Inventory::find($id);
        return response()->json($inventory);
    }

    public function bulkUpdate(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');
        $price = $request->input('price');

        try {
            $query = Inventory::whereIn('id', $ids);

            if (!is_null($status) && $status !== 'nothing') {
                $query->update(['status' => $status]);
            }

            if (!is_null($price)) {
                $query->update(['price' => $price]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
