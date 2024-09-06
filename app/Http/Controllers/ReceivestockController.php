<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\Receivestock;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReceivestockController extends Controller
{


    public function getReceivedstocks(): JsonResponse
    {
        $receivedstocks = Receivestock::with('order.supplier')->orderBy('id')->get();
        return response()->json(['data' => $receivedstocks]);
    }

    public function index(Request $request)
    {
        

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.receivedstocks');

            } elseif ($user->role === 2) {
                return view('dashboards.users.receivedstocks');

            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    public function store(Request $request)
    {
        $receivestock = Receivestock::updateOrCreate(
            ['id' => $request->receivestock_id],
            [
                'order_id' => $request->order_id,
                'receive_purchase_no' => $request->receive_purchase_no,
            ]
        );

        $order = Order::find($request->order_id);
        if ($order) {
            $order->status = 'Delivered';
            $order->save();

            foreach ($order->orderproducts as $orderProduct) {
                $product = $orderProduct->product;

                $totalQuantity = $orderProduct->quantity;

                $inventory = Inventory::where('product_id', $product->id)->first();

                if ($inventory) {
                    $inventory->quantity += $totalQuantity;
                    $inventory->incoming -= $totalQuantity;
                    $inventory->price = $product->price; 
                    $inventory->save();
                } else {
                    Inventory::create([
                        'product_id' => $product->id,
                        'quantity' => $totalQuantity,
                        'price' => $product->price,
                    ]);
                }
            }
        }

        return response()->json(['success' => 'Receive Stock Added Successfully!']);
    }
}
