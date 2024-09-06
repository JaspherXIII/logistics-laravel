@extends('layouts.app')
@section('title', 'OSave | Return List')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="">Return List</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0 return-table">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th>No.</th>
                                <th>Created Date</th>
                                <th>Return PO No.</th>
                                <th>Purchase Order No.</th>
                                <th>Supplier</th>
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

    <div class="modal fade" id="returnModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="returnForm" name="returnForm" class="form-horizontal">
                        <input type="hidden" name="return_id" id="return_id">
                        <div class="form-group">
                            <label for="name" class="control-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name" required>
                        </div>
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
                        <div class="form-group">
                            <label for="status" class="control-label">Status:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="returnSaveBtn" value="create">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewReturn" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewReturnLabel">View Return</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Return ID</th>
                                    <td id="rid"></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td id="rname"></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td id="rdescription"></td>
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
        function viewReturn(returnId) {
            $.ajax({
                url: '{{ route('user/returns.returnView') }}',
                type: 'GET',
                data: {
                    id: returnId
                },
                success: function(response) {

                    window.location.href = '{{ route('user/returns.returnView') }}?id=' + returnId;
                },
                error: function(xhr) {
                    console.error('Error fetching return details:', xhr);

                }
            });
        }
        $(function() {
            var returnTable = $('.return-table').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                lengthMenu: [10, 20, 50, 100],
                ajax: {
                    url: "{{ route('user/returns.getReturns') }}",
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
                        data: 'return_purchase_order_no',
                        name: 'return_purchase_order_no'
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
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var viewButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" onclick="viewReturn(' + full.id +
                                ')" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info mr-2"><i class="ri-eye-line mr-0"></i></a>';
                            var editButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" onclick="viewReturn(' + full.id +
                                ')" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info mr-2"><i class="ri-eye-line mr-0"></i></a>';
                            var deleteButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" data-toggle="tooltip" data-placement="top" title="Delete" class="badge bg-warning deleteReturn"><i class="ri-delete-bin-line mr-0"></i></a>';

                            return '<div class="d-flex align-items-center list-action">' +
                                editButton +
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
