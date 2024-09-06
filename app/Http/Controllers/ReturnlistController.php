<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Returnlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReturnlistController extends Controller
{
    public function getReturns(): JsonResponse
    {
        $returns = Returnlist::with('order.supplier')->orderBy('id', 'desc')->get();
        return response()->json(['data' => $returns]);
    }

    public function index(Request $request)
    {
        $orders = Order::all();

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.returns', compact('orders'));

            } elseif ($user->role === 2) {
                return view('dashboards.users.returns', compact('orders'));

            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    public function returnForm(Request $request)
    {
        $orderId = $request->query('order_id');
    
    
        $order = $orderId ? Order::with('supplier')->find($orderId) : null;
    
    
        $orders = Order::with('supplier')
            ->whereNotIn('status', ['Delivered', 'Returned', 'Failed To Receive'])
            ->get();
    
    
        $lastReturn = Returnlist::latest('created_at')->first();
        $nextReturnNo = $this->generateNextReturnNo($lastReturn ? $lastReturn->return_purchase_order_no : null);
    
        return view('dashboards.admins.returnForm', compact('orders', 'nextReturnNo', 'order', 'orderId'));
    }

    
    private function generateNextReturnNo($lastReturnNo)
    {
        if ($lastReturnNo) {
            $number = (int) substr($lastReturnNo, -4);
            $nextNumber = $number + 1;
            return 'R-PO-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        } else {
            return 'R-PO-0001';
        }
    }




    public function store(Request $request)
    {
        $return = Returnlist::updateOrCreate(
            ['id' => $request->returnlist_id],
            [
                'order_id' => $request->order_id,
                'address_id' => 1,
                'return_purchase_order_no' => $request->return_purchase_order_no,
                'shipping_date' => $request->shipping_date,
                'return_note' => $request->return_note,
            ]
        );

        if ($return) {
            $order = Order::find($request->order_id);
            if ($order) {
                $order->status = 'Returned';
                $order->save();
            }
        }

        return response()->json(['success' => 'Return saved successfully']);
    }

    public function returnView(Request $request)
    {
        $returnId = $request->input('id');

        if (!$returnId) {
            return redirect()->route('returns.index')->with('error', 'Return ID is missing');
        }

        $return = Returnlist::with(['order.orderproducts.product'])->find($returnId);

        if (!$return) {
            return redirect()->route('returns.index')->with('error', 'Return not found');
        }

        $returnProducts = $return->order->orderproducts;

        $totalAmount = $returnProducts->reduce(function ($carry, $orderProduct) {
            return $carry + ($orderProduct->product->price * $orderProduct->quantity);
        }, 0);

    
        
        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return view('dashboards.admins.returnView', compact('return', 'returnProducts', 'totalAmount'));

            } elseif ($user->role === 2) {
                return view('dashboards.users.returnView', compact('return', 'returnProducts', 'totalAmount'));

            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }
    }

    public function updateStatus($id, $status)
    {
        $validStatuses = ['To Deliver', 'Failed To Receive', 'Cancelled', 'Returned'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->route('returns.index')->with('error', 'Invalid status');
        }

        $return = Returnlist::find($id);
        if (!$return) {
            return redirect()->route('returns.index')->with('error', 'Return not found');
        }

        $return->status = $status;
        $return->save();

        if ($status === 'Returned') {
            $order = Order::find($return->order_id);
            if ($order) {
                $order->status = 'Returned';
                $order->save();
            }
        }

        $user = auth()->user();
        if ($user) {
            if ($user->role === 1) {
                return redirect()->route('returns.index')->with('success', 'Return status updated successfully');

            } elseif ($user->role === 2) {
                return redirect()->route('user/returns.index')->with('success', 'Return status updated successfully');

            } else {

                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in.');
        }

        
    }
}
