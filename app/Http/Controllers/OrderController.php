<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\Orderproduct;
use App\Models\Product;
use App\Models\Receivestock;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getTop3Orders(): JsonResponse
    {

        $orders = Order::with('supplier')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return response()->json(['data' => $orders]);
    }


    public function getOrders(): JsonResponse
    {
        $orders = Order::with('supplier')->orderBy('id', 'desc')->get();
        return response()->json(['data' => $orders]);
    }

    public function index(Request $request)
    {

        $suppliers = Supplier::all();
        $products = Product::all();

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.orders', compact('suppliers', 'products'));
            } elseif ($user->role === 2) {
                return view('dashboards.users.orders', compact('suppliers', 'products'));
            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }


    public function orderForm(Request $request)
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        $products = Product::all();

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                $lastOrder = Order::latest('created_at')->first(); 
                $nextOrderNo = $this->generateNextOrderNo($lastOrder ? $lastOrder->purchase_order_no : null);

                return view('dashboards.admins.orderForm', compact('suppliers', 'products', 'nextOrderNo'));
            } elseif ($user->role === 2) {
                $lastOrder = Order::latest('created_at')->first(); 
                $nextOrderNo = $this->generateNextOrderNo($lastOrder ? $lastOrder->purchase_order_no : null);

                return view('dashboards.users.orderForm', compact('suppliers', 'products', 'nextOrderNo'));
            } else {
                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    private function generateNextOrderNo($lastOrderNo)
    {
        if ($lastOrderNo) {
            $number = (int) substr($lastOrderNo, -4);
            $nextNumber = $number + 1;
            return 'PO-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        } else {
            return 'PO-0001';
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_order_no' => 'required|string',
            'order_products' => 'required',
            'order_products.*.product_id' => 'required|exists:products,id',
            'order_products.*.quantity' => 'required|numeric|min:1',
        ]);

        $order = Order::updateOrCreate(
            ['id' => $request->order_id],
            [
                'supplier_id' => $request->supplier_id,
                'address_id' => 1,
                'purchase_order_no' => $request->purchase_order_no,
            ]
        );

        $orderProducts = json_decode($request->order_products, true);

        if (!is_array($orderProducts)) {
            return response()->json(['error' => 'Invalid order_products format'], 422);
        }

        foreach ($orderProducts as $product) {
            Orderproduct::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                ],
                [
                    'quantity' => $product['quantity'],
                ]
            );

            $inventory = Inventory::where('product_id', $product['product_id'])->first();
            if ($inventory) {
                $inventory->incoming += $product['quantity'];
                $inventory->save();
            } else {
                Inventory::create([
                    'product_id' => $product['product_id'],
                    'quantity' => '0',
                    'price' => '0',

                    'status' => 'Inactive',
                    'incoming' => $product['quantity'],
                ]);
            }
        }

        return response()->json(['success' => 'Order saved and inventory updated successfully']);
    }


    public function show(string $id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    public function orderView(Request $request)
    {
        $orderId = $request->input('id');

        if (!$orderId) {
            return redirect()->route('orders.index')->with('error', 'Order ID is missing');
        }

        $order = Order::with(['orderproducts.product'])->find($orderId);


        $orderProducts = $order->orderproducts;
        $totalAmount = $orderProducts->reduce(function ($carry, $orderProduct) {
            return $carry + ($orderProduct->product->price * $orderProduct->quantity);
        }, 0);


        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.orderView', compact('order', 'orderProducts', 'totalAmount'));
            } elseif ($user->role === 2) {
                return view('dashboards.users.orderView', compact('order', 'orderProducts', 'totalAmount'));
            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

        public function orderReceived(Request $request)
    {
        $orderId = $request->input('id');
        $orderReceivedId = $request->input('orderReceivedId');

        if (!$orderId) {
            return redirect()->route('orders.index')->with('error', 'Order ID is missing');
        }

        $order = Order::with(['orderproducts.product'])->find($orderId);
        $orderReceived = Receivestock::find($orderReceivedId);

        $lastReceiveStock = Receivestock::latest('created_at')->first();
        $nextReceiveNo = $this->generateNextReceiveNo($lastReceiveStock ? $lastReceiveStock->receive_purchase_no : null);

        $orderProducts = $order->orderproducts;

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.orderReceived', compact('order', 'orderProducts', 'orderReceived', 'nextReceiveNo'));
            } elseif ($user->role === 2) {
                return view('dashboards.users.orderReceived', compact('order', 'orderProducts', 'orderReceived', 'nextReceiveNo'));
            } else {
                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    private function generateNextReceiveNo($lastReceiveNo)
    {
        if ($lastReceiveNo) {
            $number = (int) substr($lastReceiveNo, -4);
            $nextNumber = $number + 1;
            return 'RD-PO-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        } else {
            return 'RD-PO-0001';
        }
    }

    public function updateStatus($id, $status)
    {
        $validStatuses = ['To Deliver', 'Failed To Receive', 'Cancelled', 'Delivered', 'Returned'];
        
        // Check if the provided status is valid
        if (!in_array($status, $validStatuses)) {
            return redirect()->route('orders.index')->with('error', 'Invalid status');
        }
    
     
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }
    
    
        $order->status = $status;
        $order->save();
    
    
        $orderProducts = $order->orderProducts;
        foreach ($orderProducts as $orderProduct) {
            $inventory = Inventory::where('product_id', $orderProduct->product_id)->first();
            if ($inventory) {
                $inventory->incoming -= $orderProduct->quantity;
                $inventory->incoming = max($inventory->incoming, 0);
                $inventory->save();
            }
        }
    
    
        if ($status === 'Failed To Receive') {
            return redirect()->route('orders.orderForm')->with('success', 'Order status updated to Failed To Receive and inventory adjusted successfully');
        }
    
        return redirect()->route('orders.index')->with('success', 'Order status updated and inventory adjusted successfully');
    }

}
