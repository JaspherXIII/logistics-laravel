@extends('layouts.app')

@section('title', 'OSave | Delivery Receipt Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between ">
                    <div>
                        <h4 class="">Delivery Receipt Details</h4>
                    </div>
                    <button type="button" class="close" aria-label="Close"
                        onclick="window.location.href='{{ route('deliveryreceipts.index') }}';">
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
                        <form id="deliveryReceiptForm" name="deliveryReceiptForm" class="form-horizontal">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center text-osave"
                                            for="ReceivePicklistNo">Delivery Receipt No.*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="deliveryreceipt_no"
                                                value="{{ $deliveryReceipt->deliveryreceipt_no ?? $nextDrNo }}" readonly required>


                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="picklist_id" class="form-control"
                                        value="{{ $picklist->id }}" readonly>
                                    <input type="hidden" name="deliveryreceipt_id" class="form-control"
                                        value="{{ $deliveryReceipt->id ?? '' }}" readonly>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center text-osave" for="Picklist">
                                            Pick List No.*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $picklist->picklist_no }}"
                                                readonly>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
                                </div>



                                <div class="col-sm-12">
                                    <div class="mt-4 d-flex justify-content-between">
                                        <h6>Item Table</h6>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
                                </div>
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
                                            @php
                                                $drProduct = $drProducts->firstWhere(
                                                    'product_id',
                                                    $picklistProduct->product->id,
                                                );
                                            @endphp
                                            <tr>
                                                <input type="hidden" name="drproduct_id[]" class="form-control"
                                                    value="{{ $drProduct->id ?? '' }}">
                                                <input type="hidden" name="product_id[]" class="form-control"
                                                    value="{{ $picklistProduct->product->id }}" readonly>

                                                <th class="text-center" scope="row">{{ $index + 1 }}</th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('/' . $picklistProduct->product->image) }}"
                                                            class="img-fluid rounded avatar-50 mr-3" alt="image">
                                                        <div>{{ $picklistProduct->product->name }}</div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $picklistProduct->product->category }}</td>
                                                <td class="text-center">{{ $picklistProduct->product->unit }}</td>
                                                <td class="text-center">
                                                    <div class="form-group text-center">
                                                        <input type="text" class="form-control form-control-sm mx-auto"
                                                            name="quantity[]" value="{{ $drProduct->quantity ?? '' }}"
                                                            style="width: 80px; text-align: center;">
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="content-page2">
                    <div class="bottom-nav d-flex">
                        <div class="btn-group mr-2" role="group" aria-label="Button group with nested dropdown"
                            style="{{ !empty($deliveryReceipt->id) ? 'display: none;' : '' }}">
                            <button type="button" id="deliveryBtn" class="btn btn-secondary" value="create">Save</button>
                        </div>

                        <button type="button" class="btn btn-light"
                            onclick="window.location.href='{{ route('picklists.index') }}';">Cancel</button>
                        <button type="button" class="btn btn-outline-dark ml-2" onclick="window.print();"><i
                                class="ri-printer-line mr-0"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    $(function() {
        $('#deliveryBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Saving...'); 

            $.ajax({
                data: $("#deliveryReceiptForm").serialize(),
                url: "{{ route('deliveryreceipts.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#deliveryReceiptForm').trigger('reset');
                        Swal.fire({
                            title: "Success!",
                            text: data.message || "Delivery receipt data saved successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = '/admin/deliveryreceipts';
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: data.error || "An unknown error occurred.",
                            icon: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    console.log('Error', xhr);
                    $('#deliveryBtn').html('Save');
                    Swal.fire({
                        title: "Oops!",
                        text: xhr.responseJSON.error || "Something went wrong!",
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
