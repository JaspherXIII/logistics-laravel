@extends('layouts.app')

@section('title', 'OSave | Order Details')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between ">
                    <div>
                        <h4 class="">Purchase Order Information</h4>
                    </div>
                    <button type="button" class="close" aria-label="Close" onclick="window.location.href='{{ route('orders.index') }}';">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height print rounded">
                    <div class="card-header d-flex justify-content-between bg-success header-invoice">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">{{ $order->purchase_order_no }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product Order#</th>
                                                <th scope="col">Created Date</th>
                                                <th scope="col">Supplier</th>
                                                <th scope="col">Supplier Address</th>
                                                <th scope="col">Warehouse Address</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $order->purchase_order_no }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</td>

                                                <td>{{ $order->supplier->name }}</td>
                                                <td>
                                                    <p>{{ $order->supplier->address }}<br>
                                                       Email: {{ $order->supplier->email }}<br>
                                                       Phone: {{ $order->supplier->phone_number }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>{{ $order->address->address }}<br><br>
                                                       Email: {{ $order->address->email }}<br>
                                                       Phone: {{ $order->address->phone_number }}<br>
                                                    </p>
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeClass = '';
                                                        $badgeText = '';
                                                
                                                        switch ($order->status) {
                                                            case 'To Deliver':
                                                                $badgeClass = 'badge-success';
                                                                $badgeText = 'To Deliver';
                                                                break;
                                                            case 'Failed To Receive':
                                                                $badgeClass = 'badge-danger';
                                                                $badgeText = 'Failed To Receive';
                                                                break;
                                                            case 'Cancelled':
                                                                $badgeClass = 'badge-secondary';
                                                                $badgeText = 'Cancelled';
                                                                break;
                                                            case 'Delivered':
                                                                $badgeClass = 'badge-primary';
                                                                $badgeText = 'Delivered';
                                                                break;
                                                            case 'Returned':
                                                                $badgeClass = 'badge-warning';
                                                                $badgeText = 'Returned';
                                                                break;
                                                            default:
                                                                $badgeClass = 'badge-secondary';
                                                                $badgeText = 'Unknown';
                                                        }
                                                    @endphp
                                                
                                                    <div class="badge {{ $badgeClass }}">{{ $badgeText }}</div>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mx-auto">
                                <div class="table-responsive-sm d-flex justify-content-center">
                                    <table class="table">
                                        <thead>
                                            <tr class="light">
                                                <th class="text-center" scope="col">#</th>
                                                <th scope="col">Product</th>
                                                <th class="text-center" scope="col">Category</th>
                                                <th class="text-center" scope="col">Unit</th>
                                                <th class="text-center" scope="col">Qty</th>
                                                <th class="text-center" scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderProducts as $index => $orderProduct)
                                                <tr>
                                                    <th class="text-center" scope="row">{{ $index + 1 }}</th>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('/' . $orderProduct->product->image) }}" 
                                                                 class="img-fluid rounded avatar-50 mr-3" alt="image">
                                                            <div>
                                                                {{ $orderProduct->product->name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ $orderProduct->product->category }}</td>
                                                    <td class="text-center">{{ $orderProduct->product->unit }}</td>
                                                    <td class="text-center">{{ $orderProduct->quantity }}</td>
                                                    <td class="text-center"><b>₱{{ number_format($orderProduct->product->price * $orderProduct->quantity, 2) }}</b></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="ttl-amt py-2 px-3 d-flex justify-content-end">
                            <h6 class="text-dark">Total</h6>
                            <h4 class="text-dark font-weight-700 ml-3">₱{{ number_format($totalAmount, 2) }}</h4>
                        </div>
                    </div>
                </div>

               
                <div class="content-page2">
                    <div class="bottom-nav d-flex">
                        @if ($order->status === 'To Deliver')
                        <div class="btn-group mr-2" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-danger"
                                onclick="window.location.href='{{ route('orders.orderReceived', ['id' => $order->id]) }}';">Mark As Received</button>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="{{ route('orders.updateStatus', ['id' => $order->id, 'status' => 'To Deliver']) }}">To Deliver</a>
                                    <a class="dropdown-item" href="{{ route('orders.updateStatus', ['id' => $order->id, 'status' => 'Failed To Receive']) }}">Failed To Receive</a>
                                    <a class="dropdown-item" href="{{ route('orders.updateStatus', ['id' => $order->id, 'status' => 'Cancelled']) }}">Cancel Order</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <button type="button" class="btn btn-light ml-2"
                            onclick="window.location.href='{{ route('orders.index') }}';">Cancel</button>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
@endsection
