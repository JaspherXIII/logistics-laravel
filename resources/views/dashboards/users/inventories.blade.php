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





                    
                </div>
            </div>


            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0 inventory-table">
                        <thead>
                            <tr class="ligth ligth-data">
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
            
            function initializeDataTable() {
                var inventoryTable = $('.inventory-table').DataTable({
                    processing: true,
                    responsive: true,
                    autoWidth: false,
                    lengthMenu: [10, 20, 50, 100],
                    ajax: {
                        url: "{{ route('user/inventories.getInventories') }}",
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
                            return json.data;
                        }
                    },
                    columns: [
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
                url: "{{ route('user/inventories.getInventories') }}",
                method: 'GET',
                success: function(data) {
                    populateFilters(data);
                }
            });

        });
    </script>

@endsection
