@extends('layouts.app')
@section('title', 'OSave | Order List')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between ">
                    <div>
                        <h4 class="">Order List</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0 order-table">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th>No.</th>
                                <th>Created Date</th>
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

    <div class="modal fade" id="viewOrder" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="viewOrderLabel">Purchase Order Information</h6>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr class="ligth ligth-data">
                                    <th>Product Order#</th>
                                    <th>Created Date</th>
                                    <th>Supplier</th>
                                    <th>Supplier Address</th>
                                    <th>Warehouse Address</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                <td id="opo"></td>
                                <td id="ocd"></td>
                                <td id="os"></td>
                                <td id="os"></td>
                                <td id="ow"></td>
                                <td id="ostat"></td>
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
        function viewOrder(orderId) { 
            $.ajax({
                url: '/admin/orderView',
                type: 'GET',
                data: {
                    id: orderId
                },
                success: function(response) {

                    window.location.href = '/admin/orderView?id=' + orderId;
                },
                error: function(xhr) {
                    console.error('Error fetching order details:', xhr);

                }
            });
        }

        $(function() {
            var orderTable = $('.order-table').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                lengthMenu: [10, 20, 50, 100],
                ajax: {
                    url: "{{ route('orders.getOrders') }}",
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
                        data: 'purchase_order_no',
                        name: 'purchase_order_no'
                    },
                    {
                        data: 'supplier.name',
                        name: 'supplier.name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            var badgeClass;
                            var badgeText;

                            switch (data) {
                                case 'To Deliver':
                                    badgeClass = 'badge-success';
                                    badgeText = 'To Deliver';
                                    break;
                                case 'Failed To Receive':
                                    badgeClass = 'badge-danger';
                                    badgeText = 'Failed To Receive';
                                    break;
                                case 'Cancelled':
                                    badgeClass = 'badge-secondary';
                                    badgeText = 'Cancelled';
                                    break;
                                case 'Delivered':
                                    badgeClass = 'badge-primary';
                                    badgeText = 'Delivered';
                                    break;
                                case 'Returned':
                                    badgeClass = 'badge-warning';
                                    badgeText = 'Returned';
                                    break;
                                default:
                                    badgeClass = 'badge-secondary';
                                    badgeText = 'Unknown';
                            }

                            return '<div class="badge ' + badgeClass + '">' + badgeText + '</div>';
                        }
                    },
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var viewButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" onclick="viewOrder(' + full.id +
                                ')" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info mr-2"><i class="ri-eye-line mr-0"></i></a>';

                            var editButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" data-toggle="tooltip" data-placement="top" title="Edit" class="badge bg-success mr-2 editOrder"><i class="ri-pencil-line mr-0"></i></a>';
                            var deleteButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" data-toggle="tooltip" data-placement="top" title="Delete" class="badge bg-warning deleteOrder"><i class="ri-delete-bin-line mr-0"></i></a>';

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

            $("#createOrder").click(function() {
                $('#order_id').val('');
                $('#orderForm').trigger('reset');
                $('#modalHeading').html('Add Order');
                $('#orderModal').modal('show');
            });

            $('#orderSaveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $("#orderForm").serialize(),
                    url: "{{ route('orders.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#orderForm').trigger('reset');
                        $('#orderModal').modal('hide');
                        orderTable.ajax.reload();
                        Swal.fire({
                            title: "Success!",
                            text: "Order data saved successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(data) {
                        console.log('Error', data);
                        $('#orderSaveBtn').html('Save');
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

            $('body').on('click', '.deleteOrder', function() {
                var order_id = $(this).data("id");
                Swal.fire({
                    title: 'Confirm Delete',
                    text: "Are you sure you want to delete this order?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('orders.store') }}" + '/' + order_id,
                            success: function(data) {
                                orderTable.ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    'Order data has been deleted.',
                                    'success'
                                );
                            },
                            error: function(data) {
                                Swal.fire(
                                    'Error!',
                                    'Order cannot be deleted.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            $('body').on('click', '.editOrder', function() {
                var order_id = $(this).data("id");
                $.get("{{ route('orders.index') }}" + "/" + order_id + "/edit", function(data) {
                    $("#modalHeading").html("Edit Order");
                    $('#orderModal').modal('show');
                    $('#order_id').val(data.id);
                    $('#customer').val(data.customer);
                    $('#email').val(data.email);
                    $('#phone_number').val(data.phone_number);
                    $('#address').val(data.address);
                    $('#status').val(data.status);
                });
            });




        });
    </script>

@endsection
