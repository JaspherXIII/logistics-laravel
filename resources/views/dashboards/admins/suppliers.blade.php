@extends('layouts.app')
@section('title', 'OSave | Supplier List')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="">Supplier List</h4>

                    </div>
                    <a href="javascript:void(0)" id="createSupplier" class="btn btn-primary add-list"><i
                            class="las la-plus mr-3"></i>Add Supplier</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ttl-amt py-2 px-3 d-flex justify-content-end mt-2"></div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3 ">
                    <table class="table mb-0 supplier-table">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th>No.</th>
                                <th>Supplier</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
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

    <div class="modal fade" id="supModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="supplierForm" name="supplierForm" class="form-horizontal">
                        <input type="hidden" name="supplier_id" id="supplier_id">
                        
                        <div class="container">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-osave">Name*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label text-osave">Email*</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone_number" class="col-sm-4 col-form-label text-osave">Phone Number*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-4 col-form-label text-osave">Address*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="address" name="address" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-4 col-form-label text-osave">Status*</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="" disabled selected>Select Status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        
                    </form>
                    

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="supSaveBtn" value="create">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewSupplier" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewSupplierLabel">View Supplier</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Supplier ID</th>
                                    <td id="sid"></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td id="sname"></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td id="sdescription"></td>
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
        $(function() {
            var supplierTable = $('.supplier-table').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                lengthMenu: [10, 20, 50, 100],
                ajax: {
                    url: "{{ route('suppliers.getSuppliers') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
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
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var viewButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" data-toggle="tooltip" data-placement="top" title="View" class="badge badge-info mr-2 viewSupplier"><i class="ri-eye-line mr-0"></i></a>';
                            var editButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" data-toggle="tooltip" data-placement="top" title="Edit" class="badge bg-primary mr-2 editSupplier"><i class="ri-eye-line mr-0"></i></a>';
                            var deleteButton = '<a href="javascript:void(0)" data-id="' + full.id +
                                '" data-toggle="tooltip" data-placement="top" title="Delete" class="badge bg-warning deleteSupplier"><i class="ri-delete-bin-line mr-0"></i></a>';

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

            $("#createSupplier").click(function() {
                $('#supplier_id').val('');
                $('#supplierForm').trigger('reset');
                $('#modalHeading').html('Add Supplier');
                $('#supModal').modal('show');
            });

            $('#supSaveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $("#supplierForm").serialize(),
                    url: "{{ route('suppliers.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#supplierForm').trigger('reset');
                        $('#supModal').modal('hide');
                        supplierTable.ajax.reload();
                        Swal.fire({
                            title: "Success!",
                            text: "Supplier data saved successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(data) {
                        console.log('Error', data);
                        $('#supSaveBtn').html('Save');
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

            $('body').on('click', '.editSupplier', function() {
                var supplier_id = $(this).data("id");
                $.get("{{ route('suppliers.index') }}" + "/" + supplier_id + "/edit", function(data) {
                    $("#modalHeading").html("Supplier Details");
                    $('#supModal').modal('show');
                    $('#supplier_id').val(data.id);
                    $('#supplier_no').val(data.supplier_no);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone_number').val(data.phone_number);
                    $('#address').val(data.address);
                    $('#status').val(data.status);
                });
            });

        });
    </script>



@endsection
