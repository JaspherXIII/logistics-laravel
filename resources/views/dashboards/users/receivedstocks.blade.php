@extends('layouts.app')
@section('title', 'OSave | Received Stock List')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between ">
                    <div>
                        <h4 class="">Received Stock List</h4>

                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3 ">
                    <table class="table mb-0 receivedstock-table">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th>No.</th>
                                <th>Created Date</th>
                                <th>Received PO No.</th>
                                <th>Purchase Order No.</th>
                                <th>Supplier</th>
                                <th>Delivery Status</th>
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

    <div class="modal fade" id="receivedStockModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="receivedStockForm" name="receivedStockForm" class="form-horizontal">
                        <input type="hidden" name="received_stock_id" id="received_stock_id">
                        <div class="form-group">
                            <label for="stock_number" class="control-label">Stock Number:</label>
                            <input type="text" class="form-control" id="stock_number" name="stock_number"
                                placeholder="Enter Stock Number" required>
                        </div>
                        <div class="form-group">
                            <label for="order_id" class="control-label">Order ID:</label>
                            <input type="text" class="form-control" id="order_id" name="order_id"
                                placeholder="Enter Order ID" required>
                        </div>
                        <div class="form-group">
                            <label for="date" class="control-label">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">Status:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Received">Received</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveReceivedStockBtn" value="create">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewReceivedStock" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewReceivedStockLabel">View Received Stock</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Stock ID</th>
                                    <td id="rsid"></td>
                                </tr>
                                <tr>
                                    <th>Stock Number</th>
                                    <td id="rsnumber"></td>
                                </tr>
                                <tr>
                                    <th>Order ID</th>
                                    <td id="rsorderid"></td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td id="rsdate"></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td id="rsstatus"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function viewOrdereceived(orderId, orderReceivedId) {
            $.ajax({
                url: '{{ route('user/orders.orderReceived') }}',
                type: 'GET',
                data: {
                    id: orderId,
                    orderReceivedId: orderReceivedId
                },
                success: function(response) {
                    if (response.error) {
                        console.error(response.error);
                    } else {
                        window.location.href = '{{ route('user/orders.orderReceived') }}?id=' + orderId +
                            '&orderReceivedId=' + orderReceivedId;
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching delivery receipt details:', xhr);
                }
            });

        }

        $(function() {
            var receivedStockTable = $('.receivedstock-table').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                lengthMenu: [10, 20, 50, 100],
                ajax: {
                    url: "{{ route('user/receivedstocks.getReceivedstocks') }}",
                    method: 'GET',
                    dataType: 'JSON'
                },
                columns: [{
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            var date = new Date(data);
                            var options = {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            };
                            return date.toLocaleDateString('en-GB', options);
                        }
                    },

                    {
                        data: 'receive_purchase_no',
                        name: 'receive_purchase_no'
                    },
                    {
                        data: 'order.purchase_order_no',
                        name: 'order.purchase_order_no'
                    },
                    {
                        data: 'order.supplier.name',
                        name: 'order.supplier.name'
                    },
                    {
                        data: 'order.status',
                        name: 'order.status',
                        render: function(data, type, row) {
                            if (data === 'Delivered') {
                                return '<div class="badge badge-success">Order Received</div>';
                            }
                            return '<div class="badge badge-secondary">' + data +
                                '</div>';
                        }
                    },
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var orderId = full.order_id;
                            var orderReceivedId = full.id;

                            var viewButton = '<a href="javascript:void(0)" data-id="' + orderId +
                                '" onclick="viewOrdereceived(' + orderId + ', ' +
                                orderReceivedId +
                                ')" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info mr-2"><i class="ri-eye-line mr-0"></i></a>';

                            var orderButton = '<a href="/admin/orderForm" data-id="' + full.id +
                                '" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-secondary mr-2"><i class="ri-shopping-basket-line mr-0"></i></a>';


                            return '<div class="d-flex align-items-center list-action">' +
                                 
                                viewButton +
                                '</div>';
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





        });
    </script>
@endsection
