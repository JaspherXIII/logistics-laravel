<?php

namespace App\Http\Controllers;

use App\Models\Deliveryreceipt;
use App\Models\Drproduct;
use App\Models\Inventory;
use App\Models\Picklist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryreceiptController extends Controller
{
    public function getDeliveryreceipts(): JsonResponse
    {
        $deliveryreceipts = Deliveryreceipt::with('picklist')->orderBy('id', 'desc')->get();
        return response()->json(['data' => $deliveryreceipts]);
    }

    public function index(Request $request)
    {
        $picklist = Picklist::all();


        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.deliveryreceipts', compact('picklist'));
            } elseif ($user->role === 2) {
                return view('dashboards.users.deliveryreceipts', compact('picklist'));
            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    public function deliveryreceiptForm(Request $request)
    {
        $picklistId = $request->input('id');
        $deliveryReceiptId = $request->input('deliveryReceiptId');

        $picklist = Picklist::with(['picklistProducts.product'])->find($picklistId);
        $deliveryReceipt = Deliveryreceipt::with(['drproducts'])->find($deliveryReceiptId);

        $picklistProducts = $picklist->picklistProducts;
        $drProducts = $deliveryReceipt ? $deliveryReceipt->drProducts : collect();
        
        $lastDeliveryReceipt = Deliveryreceipt::latest('created_at')->first();
        $nextDrNo = $this->generateNextDrNo($lastDeliveryReceipt ? $lastDeliveryReceipt->deliveryreceipt_no : null);

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.deliveryreceiptForm', compact('picklist', 'picklistProducts', 'deliveryReceipt', 'drProducts', 'nextDrNo'));
            } elseif ($user->role === 2) {
                return view('dashboards.users.deliveryreceiptForm', compact('picklist', 'picklistProducts', 'deliveryReceipt', 'drProducts', 'nextDrNo'));
            } else {
                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }
    
    private function generateNextDrNo($lastDrNo)
    {
        if ($lastDrNo) {
            $number = (int) substr($lastDrNo, -4);
            $nextNumber = $number + 1;
            return 'DR-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        } else {
            return 'DR-0001';
        }
    }


    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'deliveryreceipt_no' => 'required|string|max:255',
            'picklist_id' => 'required|integer|exists:picklists,id',
            'product_id' => 'required|array',
            'product_id.*' => 'required|integer|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric|min:1',
        ]);
    
    
        $deliveryReceiptId = $request->input('deliveryreceipt_id');
        $deliveryReceipt = Deliveryreceipt::find($deliveryReceiptId);
    
        if (!$deliveryReceipt) {
            $deliveryReceipt = Deliveryreceipt::create([
                'deliveryreceipt_no' => $validatedData['deliveryreceipt_no'],
                'picklist_id' => $validatedData['picklist_id'],
            ]);
        } else {
            $deliveryReceipt->update([
                'deliveryreceipt_no' => $validatedData['deliveryreceipt_no'],
                'picklist_id' => $validatedData['picklist_id'],
            ]);
        }
    
    
        foreach ($validatedData['product_id'] as $index => $productId) {
            $quantity = $validatedData['quantity'][$index];
            $drProductId = $request->input('drproduct_id')[$index] ?? null;
    
            $inventory = Inventory::where('product_id', $productId)->first();
            if ($inventory && $inventory->quantity < $quantity) {
                return response()->json([
                    'success' => false,
                    'error' => 'Insufficient pick list quantity!',
                ], 400);
            }
    
            if ($drProductId) {
                $drProduct = Drproduct::find($drProductId);
                if ($drProduct) {
                    $drProduct->update([
                        'quantity' => $quantity,
                    ]);
                }
            } else {
                Drproduct::create([
                    'deliveryreceipt_id' => $deliveryReceipt->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
    
            if ($inventory) {
                $inventory->quantity -= $quantity;
                $inventory->save();
            }
        }
    
    
        $picklist = Picklist::find($validatedData['picklist_id']);
        if ($picklist) {
            $picklist->status = 'Marked';
            $picklist->save();
        }
    
    
        return response()->json([
            'success' => true,
            'message' => 'Delivery receipt data saved successfully!',
            'deliveryreceipt_id' => $deliveryReceipt->id,
        ]);
    }




}
