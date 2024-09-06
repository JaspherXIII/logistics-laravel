<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Picklist;
use App\Models\Picklistproduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PicklistController extends Controller
{
    public function getPicklists(): JsonResponse
    {
        $picklists = Picklist::with('address')
            ->where('status', 'Un-mark')
            ->orderBy('id', 'desc')
            ->get();
    
        return response()->json(['data' => $picklists]);
    }


    public function index(Request $request)
    {
        $inventories = Inventory::all();

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.picklists', compact('inventories'));
            } elseif ($user->role === 2) {
                return view('dashboards.users.picklists', compact('inventories'));
            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    public function picklistForm(Request $request)
    {

        $products = Product::get();

        $inventory = Inventory::where('quantity', '>', 0)
            ->where('status', 'Active')
            ->select('product_id', 'quantity')
            ->get()
            ->toArray();
            
        $lastPicklist = Picklist::latest('created_at')->first();
    $nextPicklistNo = $this->generateNextPicklistNo($lastPicklist ? $lastPicklist->picklist_no : null);


        return view('dashboards.admins.picklistForm', compact('inventory', 'products', 'nextPicklistNo'));
    }
    
    private function generateNextPicklistNo($lastPicklistNo)
    {
        if ($lastPicklistNo) {
            $number = (int) substr($lastPicklistNo, -4);
            $nextNumber = $number + 1;
            return 'PL-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        } else {
            return 'PL-0001';
        }
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'picklist_products' => 'required',
            'picklist_products.*.product_id' => 'required|exists:products,id',
            'picklist_products.*.quantity' => 'required|numeric|min:1',
        ]);
    
        $picklist = Picklist::updateOrCreate(
            ['id' => $request->picklist_id],
            [
                'picklist_no' => $request->picklist_no,
                'order_from' => $request->order_from,
                'address_id' => 2,
                'status' => 'Un-mark',
            ]
        );
    
        $picklistProducts = json_decode($request->picklist_products, true);
    
        if (!is_array($picklistProducts)) {
            return response()->json(['error' => 'Invalid picklist_products format'], 422);
        }
    
        foreach ($picklistProducts as $product) {
            $productExists = Product::find($product['product_id']);
    
            if (!$productExists) {
                return response()->json(['error' => 'Product not found for product ID: ' . $product['product_id']], 404);
            }
    
            $inventory = Inventory::where('product_id', $product['product_id'])->first();
    
            if (!$inventory || $inventory->quantity < $product['quantity']) {
                return response()->json(['error' => 'Insufficient quantity in inventory for product ID: ' . $product['product_id']], 422);
            }
    
            Picklistproduct::updateOrCreate(
                [
                    'picklist_id' => $picklist->id,
                    'product_id' => $product['product_id'],
                ],
                [
                    'quantity' => $product['quantity'],
                ]
            );
        }
    
        return response()->json(['success' => 'Picklist saved successfully']);
    }



    public function picklistView(Request $request)
    {
        $picklistId = $request->input('id');

        if (!$picklistId) {
            return redirect()->route('picklists.index')->with('error', 'Picklist ID is missing');
        }

        $picklist = Picklist::with(['picklistproducts.product'])->find($picklistId);

        if (!$picklist) {
            return redirect()->route('picklists.index')->with('error', 'Picklist not found');
        }

        $picklistProducts = $picklist->picklistproducts;

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.picklistView', compact('picklist', 'picklistProducts'));
            } elseif ($user->role === 2) {
                return view('dashboards.users.picklistView', compact('picklist', 'picklistProducts'));
            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }
}
