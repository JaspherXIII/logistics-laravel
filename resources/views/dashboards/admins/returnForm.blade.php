@extends('layouts.app')
@section('title', 'OSave | Return Form')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="">Return Purchase Order</h4>
                    </div>
                    <button type="button" class="close" aria-label="Close"
                        onclick="window.location.href='{{ route('orders.index') }}';">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2">
                </div>
            </div>
            <div class="col-lg-12">
                <form id="returnForm" name="returnForm" class="form-horizontal">
                    <input type="hidden" name="order_id" id="order_id">


                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center text-osave">Return PO No.*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="return_purchase_order_no"
                                        name="return_purchase_order_no" value="{{ $nextReturnNo }}" required readonly>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center text-osave" for="order">Purchase Order No.*</label>
                                <div class="col-sm-9">
                                    <select name="order_id" id="order_id" class="selectpicker form-control" data-style="py-0">
                                        <option value="" disabled {{ !request()->query('order_id') ? 'selected' : '' }}>Select order</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}" 
                                                data-name="{{ $order->supplier->name }}"
                                                data-email="{{ $order->supplier->email }}"
                                                data-phone="{{ $order->supplier->phone_number }}"
                                                data-address="{{ $order->supplier->address }}"
                                                {{ $orderId == $order->id ? 'selected' : '' }}>
                                                {{ $order->purchase_order_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center text-osave" for="deliver-address"></label>
                                <p class="col-sm-5 ml-2 mb-0">
                                    Supplier: <span id="order-name">Not selected</span><br>
                                    Address: <span id="order-address">Not selected</span><br>
                                    Email: <span id="order-email">Not selected</span><br>
                                    Phone: <span id="order-phone">Not selected</span>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center text-osave">Shipping Date*</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="shipping_date" name="shipping_date"
                                        required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <h4 class="mb-3">Destination</h4>
                                <a href="javascript:void(0)" id="editAddress" class="badge badge-success mr-2"><i
                                        class="ri-pencil-line mr-0"></i> </a>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center text-osave"
                                    for="deliver-address">Delivery Address*</label>
                                <p class="ml-3 mb-0 delivery-address">
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center text-osave">Return Note*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="return_note"
                                        name="return_note" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>



                    </div>
                </form>
                <div class="content-page2">
                    <div class="bottom-nav">
                        <button type="submit" class="btn btn-primary mr-2 ml-2" id="returnBtn" value="create">Request
                            Return</button>
                        <button type="button" class="btn btn-light"
                            onclick="window.location.href='{{ route('returns.index') }}';">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addressModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading">Edit Address</h4>
                </div>
                <div class="modal-body">
                    <form id="addressForm" name="addressForm" class="form-horizontal">
                        <input type="hidden" name="address_id" id="address_id">
                        <div class="form-group">
                            <label for="email" class="control-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="control-label">Phone Number:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Enter Phone Number" required>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Enter Address" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addressSaveBtn" value="create">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script>
       
        $(function() {

            function updateAddressDetails() {
                $.ajax({
                    url: "{{ route('addresses.show', 1) }}", 
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        $('.delivery-address').html(
                            'Address: ' + data.address + '<br>' +
                            'Email: ' + data.email + '<br>' +
                            'Phone: ' + data.phone_number
                        );
                    },
                    error: function(xhr) {
                        console.log('Error fetching address data:', xhr);
                        Swal.fire({
                            title: "Oops!",
                            text: "Failed to load address data!",
                            icon: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
            updateAddressDetails();


            $("#editAddress").click(function() {
                var addressId = 1;

                $.ajax({
                    url: "{{ route('addresses.show', '') }}/" +
                        addressId,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        $('#address_id').val(data.id);
                        $('#email').val(data.email);
                        $('#phone_number').val(data.phone_number);
                        $('#address').val(data.address);

                        $('#addressModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log('Error fetching address data:', xhr);
                        Swal.fire({
                            title: "Oops!",
                            text: "Failed to load address data!",
                            icon: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });

            $('#addressSaveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Saving...'); 

                $.ajax({
                    data: $("#addressForm").serialize(),
                    url: "{{ route('addresses.store') }}", 
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#addressForm').trigger('reset');
                        $('#addressModal').modal('hide');
                        Swal.fire({
                            title: "Success!",
                            text: "Address data saved successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        updateAddressDetails();
                    },
                    error: function(xhr) {
                        console.log('Error saving address data:', xhr);
                        $('#addressSaveBtn').html('Save');
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

            $('#addressModal').on('hidden.bs.modal', function() {
                $('#addressSaveBtn').html('Save');
            });


            function updateOrderDetails() {
                var selectedOption = $('select[name="order_id"]').find('option:selected');
                var name = selectedOption.data('name');
                var email = selectedOption.data('email');
                var phone = selectedOption.data('phone');
                var address = selectedOption.data('address');
        
                $('#order-name').text(name || 'Not available');
                $('#order-address').text(address || 'Not available');
                $('#order-email').text(email || 'Not available');
                $('#order-phone').text(phone || 'Not available');
            }
        
            $('select[name="order_id"]').on('change', function() {
                updateOrderDetails();
            });
        
            if ($('select[name="order_id"]').val()) {
                updateOrderDetails();
            }

            $('#returnBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $("#returnForm").serialize(),
                    url: "{{ route('returns.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#returnForm').trigger('reset');
                        Swal.fire({
                            title: "Success!",
                            text: "Return details saved successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = '/admin/returns';
                        });
                    },
                    error: function(data) {
                        console.log('Error', data);
                        $('#returnBtn').html('Save');
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
