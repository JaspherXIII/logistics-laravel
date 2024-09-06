@extends('layouts.app')

@section('title', 'OSave | Pick List Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="">Pick List Information</h4>
                    </div>
                    <button type="button" class="close" aria-label="Close" onclick="window.location.href='{{ route('picklists.index') }}';">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height print rounded">
                    <div class="card-header d-flex justify-content-between bg-secondary header-invoice">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">{{ $picklist->picklist_no }}</h4>
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
                                                <th scope="col">Pick List No.</th>
                                                <th scope="col">Order From</th>
                                                <th scope="col">Deliver To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($picklist->created_at)->format('d F Y') }}</td>

                                                <td>{{ $picklist->picklist_no }}</td>
                                                <td>{{ $picklist->order_from}}</td>
                                                <td>
                                                    <p>{{ $picklist->address->address }}<br>
                                                       Email: {{ $picklist->address->email }}<br>
                                                       Phone: {{ $picklist->address->phone_number }}<br>
                                                    </p>
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
                                                <th class="text-center" scope="col">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($picklistProducts as $index => $picklistProduct)
                                                <tr>
                                                    <th class="text-center" scope="row">{{ $index + 1 }}</th>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('/' . $picklistProduct->product->image) }}" 
                                                                 class="img-fluid rounded avatar-50 mr-3" alt="image">
                                                            <div>
                                                                {{ $picklistProduct->product->name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ $picklistProduct->product->category }}</td>
                                                    <td class="text-center">{{ $picklistProduct->product->unit }}</td>
                                                    <td class="text-center">{{ $picklistProduct->quantity }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-page2">
                    <div class="bottom-nav d-flex">
                         @if ($picklist->status === 'Un-mark')
                        <div class="btn-group mr-2" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='{{ route('deliveryreceipts.deliveryreceiptForm', ['id' => $picklist->id]) }}';">Mark As Delivery Receipt</button>
                            
                        </div>
                        @endif
                        <button type="button" class="btn btn-light"
                            onclick="window.location.href='{{ route('picklists.index') }}';">Cancel</button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection
