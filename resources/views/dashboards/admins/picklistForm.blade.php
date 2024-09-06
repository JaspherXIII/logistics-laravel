@extends('layouts.app')
@section('title', 'OSave | Pick List Form')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="">Pick List Form</h4>
                    </div>
                    <button type="button" class="close" aria-label="Close"
                        onclick="window.location.href='{{ route('picklists.index') }}';">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2">
                </div>
            </div>
            <div class="col-lg-12">
                <form id="orderForm" name="orderForm" class="form-horizontal">
                    <input type="hidden" name="order_id" id="order_id">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center text-osave" for="order_from">Pick
                                    List No*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="picklist_no" name="picklist_no" value="{{ $nextPicklistNo }}" required readonly
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center text-osave" for="order_from">Order
                                    From*</label>
                                <div class="col-sm-9">
                                    <select name="order_from" id="order_from" class="selectpicker form-control"
                                        data-style="py-0">
                                        <option value="" disabled selected>Select Order From</option>
                                        <option value="Regional Officee">Regional Office</option>
                                        <option value="Store">Store</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <h4 class="mb-3">Shipping Information</h4>
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
                        <div class="col-sm-12">
                            <div class="mt-3 d-flex justify-content-between">
                                <h6>Item Table</h6>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2">
                            </div>
                        </div>
                        <table class="table table-hover" id="itemTable">
                            <thead>
                                <tr class="ligth ligth-data-left">
                                    <th>Product Details</th>
                                    <th>Unit</th>
                                    <th>Available</th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="light-body-left">
                            </tbody>
                        </table>


                        <div class="col-md-12">
                            <div class="btn-group ml-2" role="group" aria-label="Button group with nested dropdown">
                                <button type="button" class="btn btn-light" id="add-new-row">Add New
                                    Row</button>
                                <div class="btn-group" role="group">
                                    <button id="addBulk" type="button" class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="addBulk">
                                        <a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-lg">Add
                                            items in Bulk</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                <div class="content-page2">
                    <div class="bottom-nav">
                        <button type="submit" class="btn btn-primary mr-2 ml-2" id="picklistBtn"
                            value="create">Save</button>
                        <button type="button" class="btn btn-light"
                            onclick="window.location.href='{{ route('picklists.index') }}';">Cancel</button>
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

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Items in Bulk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bulkForm">
                        <div class="form-group">
                            <label for="bulkProductSelect">Select Products</label>
                            <select id="bulkProductSelect" class="form-control" multiple>

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add to Order</button>
                    </form>
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
                    url: "{{ route('addresses.show', 2) }}",
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
                var addressId = 2;

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




            var products = @json($products);
            var inventory = @json($inventory);

            function updateProductDropdowns() {
                var selectedProductIds = [];
                $('select[name="product_id"]').each(function() {
                    var selectedId = $(this).val();
                    if (selectedId) {
                        selectedProductIds.push(parseInt(selectedId));
                    }
                });

                var filteredProducts = products.filter(function(product) {
                    return inventory.some(inv => inv.product_id === product.id) && !selectedProductIds
                        .includes(product.id);
                });

                $('select[name="product_id"]').each(function() {
                    var $select = $(this);
                    var currentValue = $select.val();

                    $select.find('option:not(:selected)').remove();
                    $select.append('<option value="" disabled>Select Product</option>');

                    filteredProducts.forEach(function(product) {
                        var productInventory = inventory.find(inv => inv.product_id === product.id);
                        var quantity = productInventory ? productInventory.quantity : 'N/A';

                        if (product.id != currentValue) {
                            $select.append('<option value="' + product.id + '" data-unit="' +
                                product.unit + '" data-quantity="' + quantity +
                                '" data-image="' + product.image + '">' +
                                '<img src="/' + product.image + '" alt="' + product.name +
                                '" style="width: 50px; height: 50px; vertical-align: middle;"> ' +
                                product.name + '</option>');
                        }
                    });

                    if (currentValue) {
                        $select.val(currentValue);
                        $select.find('option:selected').css('color', 'black');
                    } else {
                        $select.val('');
                    }
                });
            }

            $('#add-new-row').on('click', function() {
                var rowHtml = `
        <tr>
            <td>
                <select name="product_id" class="form-control" required>
                    <option value="" disabled selected></option>
                </select>
            </td>
            <td><input type="text" name="unit" class="form-control" readonly></td>
            <td><input type="text" name="inventory_quantity" class="form-control" readonly></td>
            <td><input type="number" name="order_quantity" class="form-control" min="1" required></td>
            <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
        </tr>
    `;
                $('#itemTable tbody').append(rowHtml);
                updateProductDropdowns();
            });

            $('#itemTable').on('change', 'select[name="product_id"]', function() {
                var $row = $(this).closest('tr');
                var selectedOption = $(this).find('option:selected');
                var unit = selectedOption.data('unit');
                var quantity = selectedOption.data('quantity') || 'N/A';

                $row.find('input[name="unit"]').val(unit || 'N/A');
                $row.find('input[name="inventory_quantity"]').val(quantity);

                $row.find('input[name="order_quantity"]').attr('max', quantity);

                $(this).css('color', 'black');

                updateProductDropdowns();
            });

            $('#itemTable').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
                updateProductDropdowns();
            });

            function populateBulkSelect() {
                var selectedProductIds = [];
                $('select[name="product_id"]').each(function() {
                    var selectedId = $(this).val();
                    if (selectedId) {
                        selectedProductIds.push(parseInt(selectedId));
                    }
                });

                var filteredProducts = products.filter(function(product) {
                    return inventory.some(inv => inv.product_id === product.id) && !selectedProductIds
                        .includes(product.id);
                });

                var $bulkProductSelect = $('#bulkProductSelect');
                $bulkProductSelect.empty();

                filteredProducts.forEach(function(product) {
                    var productInventory = inventory.find(inv => inv.product_id === product.id);
                    var quantity = productInventory ? productInventory.quantity : 'N/A';

                    $bulkProductSelect.append('<option value="' + product.id + '" data-unit="' +
                        product.unit + '" data-quantity="' + quantity +
                        '" data-image="' + product.image + '">' +
                        '<img src="/' + product.image + '" alt="' + product.name +
                        '" style="width: 50px; height: 50px; vertical-align: middle;"> ' +
                        product.name + '</option>');
                });
            }

            $('#addBulk').on('click', function() {
                populateBulkSelect();
            });

            $('#bulkForm').on('submit', function(e) {
                e.preventDefault();

                var selectedProducts = $('#bulkProductSelect').val();
                if (selectedProducts.length === 0) {
                    alert('Please select at least one product.');
                    return;
                }

                selectedProducts.forEach(function(productId) {
                    var product = products.find(p => p.id == productId);
                    var productInventory = inventory.find(inv => inv.product_id === product.id);
                    var quantity = productInventory ? productInventory.quantity : 'N/A';

                    if (product) {
                        var rowHtml = `
                <tr>
                    <td>
                        <select name="product_id" class="form-control" required>
                            <option value="${product.id}" selected data-unit="${product.unit}" data-quantity="${quantity}" data-image="${product.image}">
                                <img src="/${product.image}" alt="${product.name}" style="width: 50px; height: 50px; vertical-align: middle;"> ${product.name}
                            </option>
                        </select>
                    </td>
                    <td><input type="text" name="unit" class="form-control" value="${product.unit}" readonly></td>
                    <td><input type="text" name="inventory_quantity" class="form-control" value="${quantity}" readonly></td>
                    <td><input type="number" name="order_quantity" class="form-control" min="1" max="${quantity}" required></td>
                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                </tr>
            `;
                        $('#itemTable tbody').append(rowHtml);
                    }
                });

                $('#bulkForm')[0].reset();
                $('#bulkProductSelect').empty();
                $('.modal').modal('hide');
                updateProductDropdowns();
            });



                $('#picklistBtn').click(function(e) {
                e.preventDefault();
                
                var $button = $(this);
                $button.prop('disabled', true).html('Saving...');
        
                var formData = new FormData($("#orderForm")[0]);
        
                var picklistProducts = [];
                var isValid = true; // Flag to check if all rows are valid
        
                $('#itemTable tbody tr').each(function() {
                    var row = $(this);
                    var product_id = row.find('select[name="product_id"]').val();
                    var quantity = row.find('input[name="order_quantity"]').val();
        
                    if (product_id && quantity) {
                        picklistProducts.push({
                            product_id: product_id,
                            quantity: quantity
                        });
                    } else {
                        isValid = false;
                        return false; 
                    }
                });
        
                if (!isValid) {
                    $button.prop('disabled', false).html('Save');
                    Swal.fire({
                        title: "Validation Error!",
                        text: "Please fill in all quantities.",
                        icon: "warning",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return; 
                }
        
                formData.append('picklist_products', JSON.stringify(picklistProducts));
        
                $.ajax({
                    data: formData,
                    url: "{{ route('picklists.store') }}",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        $('#orderForm').trigger('reset');
                        $('#itemTable tbody').empty(); 
        
                        Swal.fire({
                            title: "Success!",
                            text: "Pick List saved successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = '/admin/picklists';
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error', error);
                        $button.prop('disabled', false).html('Save');
                        
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
