@extends('layouts.app')
@section('title', 'OSave | Delivery Receipts')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4>Delivery Receipts</h4>

                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0 delivery-receipt-table">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th>No.</th>
                                <th>Created Date</th>
                                <th>Delivery Receipt No.</th>
                                <th>Pick List No.</th>
                                <th>Order From</th>
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

@endsection

@section('scripts')
    <script>
        function viewDeliveryReceipt(picklistId, deliveryReceiptId) {
            $.ajax({
                url: '{{ route('user/deliveryreceipts.deliveryreceiptForm') }}',
                type: 'GET',
                data: {
                    id: picklistId,
                    deliveryReceiptId: deliveryReceiptId
                },
                success: function(response) {
                    if (response.error) {
                        console.error(response.error);
                    } else {
                        window.location.href = '{{ route('user/deliveryreceipts.deliveryreceiptForm') }}?id=' + picklistId +
                            '&deliveryReceiptId=' + deliveryReceiptId;
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching delivery receipt details:', xhr);
                }
            });

        }


        $(function() {
            var deliveryReceiptTable = $('.delivery-receipt-table').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                lengthMenu: [10, 20, 50, 100],
                ajax: {
                    url: "{{ route('user/deliveryreceipts.getDeliveryreceipts') }}",
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
                        data: 'deliveryreceipt_no',
                        name: 'deliveryreceipt_no'
                    },
                    {
                        data: 'picklist.picklist_no',
                        name: 'picklist.picklist_no'
                    },
                    {
                        data: 'picklist.order_from',
                        name: 'picklist.order_from'
                    },
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var picklistId = full.picklist_id;
                            var deliveryReceiptId = full.id;

                            var viewButton = '<a href="javascript:void(0)" data-id="' + picklistId +
                                '" onclick="viewDeliveryReceipt(' + picklistId + ', ' +
                                deliveryReceiptId +
                                ')" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info mr-2"><i class="ri-eye-line mr-0"></i></a>';

                            var editButton = '<a href="javascript:void(0)" data-id="' + picklistId +
                                '" data-toggle="tooltip" data-placement="top" title="Edit" class="badge bg-success mr-2 editDeliveryReceipt"><i class="ri-pencil-line mr-0"></i></a>';

                            var deleteButton = '<a href="javascript:void(0)" data-id="' +
                                picklistId +
                                '" data-toggle="tooltip" data-placement="top" title="Delete" class="badge bg-warning deleteDeliveryReceipt"><i class="ri-delete-bin-line mr-0"></i></a>';

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
