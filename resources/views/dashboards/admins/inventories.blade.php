@extends('layouts.app')
@section('title', 'OSave | Product Inventory')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="">Product Inventory</h4>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-4 col-md-4 mt-5">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                            <div class="icon iq-icon-box-2 bg-info-light">
                                <img src="/logistic-assets/images/product/1.png" class="img-fluid" alt="image">
                            </div>
                            <div>
                                <p class="mb-2">In Stocks</p>
                                <h4 id="inStockCount">0</h4>
                            </div>
                        </div>
                        <div class="iq-progress-bar mt-2">
                            <span class="bg-primary iq-progress progress-1" data-percent="89"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mt-5">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                            <div class="icon iq-icon-box-2 bg-danger-light">
                                <img src="/logistic-assets/images/product/2.png" class="img-fluid" alt="image">
                            </div>
                            <div>
                                <p class="mb-2">Low In Stock</p>
                                <h4 id="lowInStockCount">0</h4>
                            </div>
                        </div>
                        <div class="iq-progress-bar mt-2">
                            <span class="bg-secondary iq-progress progress-1" data-percent="36"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mt-5">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                            <div class="icon iq-icon-box-2 bg-success-light">
                                <img src="/logistic-assets/images/product/3.png" class="img-fluid" alt="image">
                            </div>
                            <div>
                                <p class="mb-2">Out of Stock</p>
                                <h4 id="outOfStockCount">0</h4>
                            </div>
                        </div>
                        <div class="iq-progress-bar mt-2">
                            <span class="bg-danger iq-progress progress-1" data-percent="26"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center mt-4 mb-3 ml-3">
                    <div class="col-md-2">
                        <label for="categoriesFilter">Filter by Category:</label>
                        <select id="categoriesFilter" class="form-control">
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="stocksFilter">Filter by Stock Status:</label>
                        <select id="stocksFilter" class="form-control">
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="itemsFilter">Filter by Item Status:</label>
                        <select id="itemsFilter" class="form-control">
                        </select>
                    </div>





                    <div class="ml-auto mr-6">
                        <button type="button" class="btn btn-outline-primary mt-4" data-toggle="modal"
                            data-target=".bd-example-modal-sm">Bulk Update</button>
                        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Bulk Update</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Item Status</label>
                                            <select id="bulkStatus" class="form-control">
                                                <option value="nothing">Nothing Selected</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                                <option value="Delisted">Delisted</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cost Price</label>
                                            <input id="bulkPrice" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="bulkUpdateBtn">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="/admin/orders" class="btn btn-secondary ml-3 mt-4">
                            <i class="ri-shopping-basket-line mr-2"></i>Order
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0 inventory-table">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th></th>
                                <th>No.</th>
                                <th>Product Description</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Cost Price</th>
                                <th>Supplier</th>
                                <th>Stoct Status</th>
                                <th>Item Status</th>
                                <th>Incoming</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="invModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="inventoryForm" name="inventoryForm" class="form-horizontal">
                        <input type="hidden" name="inventory_id" id="inventory_id">
                        <input type="hidden" class="form-control" id="product_id" name="product_id"
                            placeholder="Enter Product ID" required>
                        <div class="form-group">
                            <label for="price" class="control-label">Price:</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="Enter Price" required>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">Status:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Delisted">Delisted</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="invSaveBtn" value="create">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function updateStockStatusCards(data) {
                var inStockCount = 0;
                var lowInStockCount = 0;
                var outOfStockCount = 0;

                data.forEach(function(item) {
                    var quantity = item.quantity;
                    if (quantity === 0) {
                        outOfStockCount++;
                    } else if (quantity < 10) {
                        lowInStockCount++;
                    } else {
                        inStockCount++;
                    }
                });

                $('#inStockCount').text(inStockCount);
                $('#lowInStockCount').text(lowInStockCount);
                $('#outOfStockCount').text(outOfStockCount);
            }

            function initializeDataTable() {
                var inventoryTable = $('.inventory-table').DataTable({
                    processing: true,
                    responsive: true,
                    autoWidth: false,
                    lengthMenu: [10, 20, 50, 100],
                    ajax: {
                        url: "{{ route('inventories.getInventories') }}",
                        method: 'GET',
                        dataType: 'JSON',
                        data: function(d) {
                            d.category = $('#categoriesFilter').val() !== 'all' ? $('#categoriesFilter')
                                .val() : '';
                            d.stock_status = $('#stocksFilter').val() !== 'all' ? $('#stocksFilter')
                                .val() : '';
                            d.item_status = $('#itemsFilter').val() !== 'all' ? $('#itemsFilter')
                                .val() : '';
                        },
                        dataSrc: function(json) {
                            updateStockStatusCards(json.data);
                            return json.data;
                        }
                    },
                    columns: [{
                            data: null,
                            searchable: false,
                            orderable: false,
                            render: function(data, type, full) {
                                return '<input type="checkbox" class="itemCheckbox" value="' + full
                                    .id + '">';
                            }
                        },
                        {
                            data: null,
                            searchable: false,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: 'product',
                            name: 'product.name',
                            render: function(data) {
                                var imageUrl = data.image;
                                var productName = data.name;
                                return '<img src="/' + imageUrl + '" alt="' + productName +
                                    '" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">' +
                                    productName;
                            }
                        },
                        {
                            data: 'product.category',
                            name: 'product.category'
                        },
                        {
                            data: 'product.unit',
                            name: 'product.unit'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity',
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'product.supplier.name',
                            name: 'product.supplier.name'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity',
                            render: function(data) {
                                if (data === 0) {
                                    return '<span class="badge bg-danger">Out of Stock</span>';
                                } else if (data < 10) {
                                    return '<span class="badge bg-secondary">Low In Stock</span>';
                                } else {
                                    return '<span class="badge bg-primary">In Stock</span>';
                                }
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data) {
                                if (data === 'Active') {
                                    return '<div class="badge bg-success">Active</div>';
                                } else if (data === 'Inactive') {
                                    return '<div class="badge bg-danger">Inactive</div>';
                                } else if (data === 'Delisted') {
                                    return '<div class="badge bg-secondary">Delisted</div>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'incoming',
                            name: 'incoming',
                            render: function(data) {
                                return data === null ? '0' : data;
                            }
                        },
                        {
                            data: null,
                            searchable: false,
                            orderable: false,
                            render: function(data, type, full) {
                                var viewButton = '<a href="javascript:void(0)" data-id="' + full
                                    .id +
                                    '" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info mr-2 editInventory"><i class="ri-eye-line mr-0"></i></a>';
                                var deleteButton = '<a href="javascript:void(0)" data-id="' + full
                                    .id +
                                    '" data-toggle="tooltip" data-placement="top" title="Delete" class="badge bg-warning deleteInventory"><i class="ri-delete-bin-line mr-0"></i></a>';
                                return '<div class="d-flex align-items-center list-action">' +
                                    viewButton + '</div>';
                            }
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5',
                        'print',
                        'colvis'
                    ]
                });

                $('#categoriesFilter, #stocksFilter, #itemsFilter').change(function() {
                    inventoryTable.ajax.reload();
                });

                $('#selectAll').click(function() {
                    var isChecked = $(this).is(':checked');
                    $('.itemCheckbox').prop('checked', isChecked);
                });
            }

            function populateFilters(data) {
                var categoryOptions = '<option value="all">All</option>';
                data.categories.forEach(function(category) {
                    categoryOptions += '<option value="' + category + '">' + category + '</option>';
                });
                $('#categoriesFilter').html(categoryOptions);

                var stockStatusOptions = '<option value="all">All</option>';
                data.stockStatuses.forEach(function(status) {
                    stockStatusOptions += '<option value="' + status + '">' + status + '</option>';
                });
                $('#stocksFilter').html(stockStatusOptions);

                var statusOptions = '<option value="all">All</option>';
                data.statuses.forEach(function(status) {
                    statusOptions += '<option value="' + status + '">' + status + '</option>';
                });
                $('#itemsFilter').html(statusOptions);

                initializeDataTable();
            }

            $.ajax({
                url: "{{ route('inventories.getInventories') }}",
                method: 'GET',
                success: function(data) {
                    populateFilters(data);
                }
            });

            $('#bulkUpdateBtn').click(function() {
                var selectedIds = [];
                $('.itemCheckbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    Swal.fire({
                        title: "Warning!",
                        text: "No items selected!",
                        icon: "warning",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }

                var data = {
                    _token: '{{ csrf_token() }}',
                    ids: selectedIds
                };

                var status = $('#bulkStatus').val();
                var price = $('#bulkPrice').val();

                if (status && status !== 'nothing') {
                    data.status = status;
                }

                if (price) {
                    data.price = price;
                }

                $.ajax({
                    url: "{{ route('inventories.bulkUpdate') }}",
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function() {
                        $('.inventory-table').DataTable().ajax.reload();
                        $('#bulkUpdateBtn').html('Save changes');
                        Swal.fire({
                            title: "Success!",
                            text: "Selected items updated successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('.bd-example-modal-sm').modal('hide');
                    },
                    error: function() {
                        $('#bulkUpdateBtn').html('Save changes');
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


            $('body').on('click', '.editInventory', function() {
                var inventory_id = $(this).data("id");
                $.get("{{ route('inventories.index') }}" + "/" + inventory_id + "/edit", function(data) {
                    $("#modalHeading").html("Edit Inventory Item");
                    $('#invModal').modal('show');
                    $('#inventory_id').val(data.id);
                    $('#product_id').val(data.product_id);
                    $('#quantity').val(data.quantity);
                    $('#price').val(data.price);
                    $('#status').val(data.status);
                });
            });

            $('#invSaveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $("#inventoryForm").serialize(),
                    url: "{{ route('inventories.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#inventoryForm').trigger('reset');
                        $('#invModal').modal('hide');
                        $('.inventory-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: "Success!",
                            text: "Inventory data saved successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(data) {
                        console.log('Error', data);
                        $('#invSaveBtn').html('Save');
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
