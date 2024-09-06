@extends('layouts.app')

@section('title', 'OSave | Return Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between ">
                    <div>
                        <h4 class="">Purchase Return Information</h4>
                    </div>
                    <button type="button" class="close" aria-label="Close" onclick="window.location.href='{{ route('user/returns.index') }}';">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height print rounded">
                    <div class="card-header d-flex justify-content-between bg-danger header-invoice">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">{{ $return->return_purchase_order_no }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Created Date</th>
                                                <th scope="col">Return PO No.</th>
                                                <th scope="col">Purchase Order No.</th>
                                                <th scope="col">Shipping Date</th>
                                                <th scope="col">Supplier</th>
                                                <th scope="col">Supplier  Address</th>
                                                <th scope="col">Warehouse Address</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($return->created_at)->format('d F Y') }}</td>
                                                <td>{{ $return->return_purchase_order_no }}</td>
                                                <td>{{ $return->order->purchase_order_no }}</td>
                                                <td>{{ $return->shipping_date }}</td>
                                                <td>{{ $return->order->supplier->name }}</td>
                                                <td>
                                                    <p>{{ $return->order->supplier->address }}<br>
                                                       Email: {{ $return->order->supplier->email }}<br>
                                                       Phone: {{ $return->order->supplier->phone_number }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>{{ $return->address->address }}<br><br>
                                                       Email: {{ $return->address->email }}<br>
                                                       Phone: {{ $return->address->phone_number }}<br>
                                                    </p>
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeClass = '';
                                                        $badgeText = '';
                                                
                                                        switch ($return->status) {
                                                            case 'In Transit':
                                                                $badgeClass = 'badge-secondary';
                                                                $badgeText = 'In Transit';
                                                                break;
                                                            case 'Returned':
                                                                $badgeClass = 'badge-warning';
                                                                $badgeText = 'Returned';
                                                                break;
                                                            default:
                                                                $badgeClass = 'badge-primary';
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
                                            @foreach ($returnProducts as $index => $returnProduct)
                                                <tr>
                                                    <th class="text-center" scope="row">{{ $index + 1 }}</th>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('/' . $returnProduct->product->image) }}" 
                                                                 class="img-fluid rounded avatar-50 mr-3" alt="image">
                                                            <div>
                                                                {{ $returnProduct->product->name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ $returnProduct->product->category }}</td>
                                                    <td class="text-center">{{ $returnProduct->product->unit }}</td>
                                                    <td class="text-center">{{ $returnProduct->quantity }}</td>
                                                    <td class="text-center"><b>₱{{ number_format($returnProduct->product->price * $returnProduct->quantity, 2) }}</b></td>
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
                        @if ($return->status === 'In Transit')
                        <div class="btn-group mr-2" role="group" aria-label="Button group with nested dropdown">
                           
                            <a class="btn btn-danger" href="{{ route('user/returns.updateStatus', ['id' => $return->id, 'status' => 'Returned']) }}">Mark As Returned</a>
                        </div>
                        @endif
                        <button type="button" class="btn btn-light"
                            onclick="window.location.href='{{ route('user/returns.index') }}';">Cancel</button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection
