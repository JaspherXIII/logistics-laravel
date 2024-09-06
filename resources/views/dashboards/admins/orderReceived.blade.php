@extends('layouts.app')

@section('title', 'OSave | Order Received')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="">Purchase Received</h4>
                    </div>
                    <button type="button" class="close" aria-label="Close"
                        onclick="window.location.href='{{ route('orders.index') }}';">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height print rounded">
                    <div class="card-body">
                        <form id="orderReceivedForm" name="orderReceivedForm" class="form-horizontal">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center text-osave"
                                            for="RD-PO">Received PO No.*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="receive_purchase_no"
                                                value="{{ old('receive_purchase_no', $orderReceived->receive_purchase_no ?? $nextReceiveNo) }}" readonly required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <input type="hidden" name="order_id" class="form-control" value="{{ $order->id }}"
                                        readonly>
                                    <input type="hidden" name="receivestock_id" class="form-control"
                                        value="{{ $orderReceived->id ?? '' }}" readonly>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center text-osave" for="PO">
                                            Supplier*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $order->supplier->name }}"
                                                readonly>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center text-osave"
                                            for="PO">Purchase
                                            Order No.*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                value="{{ $order->purchase_order_no }}" readonly>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mt-4 d-flex justify-content-between">
                                        <h6>Item Table</h6>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2">
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr class="light">
                                            <th class="text-center" scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th class="text-center" scope="col">Category</th>
                                            <th class="text-center" scope="col">Unit</th>
                                            <th class="text-center" scope="col">Qty</th>
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

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>



                    </div>
                </div>

                <div class="content-page2">
                    @if ($order->status !== 'Delivered')
                        <div class="bottom-nav d-flex">
                            <div class="btn-group mr-2" role="group" aria-label="Button group with nested dropdown">
                                <button type="button" id="receivedBtn" class="btn btn-secondary" value="create">Add To
                                    Inventory</button>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="submit" class="btn btn-light dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{ route('returns.returnForm', ['order_id' => $order->id]) }}">Return Product</a>
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

@section('scripts')
    <script>
        $(function() {
            $('#receivedBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $("#orderReceivedForm").serialize(),
                    url: "{{ route('receivedstocks.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#orderReceivedForm').trigger('reset');
                        $('#supModal').modal('hide');
                        Swal.fire({
                            title: "Success!",
                            text: "Order received successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = '/admin/receivedstocks';
                        });
                    },
                    error: function(data) {
                        console.log('Error', data);
                        $('#receivedBtn').html('Save');
                        Swal.fire({
                            title: "Oops!",
                            text: "Something went wrong!",
                            icon: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });
    </script>



@endsection
