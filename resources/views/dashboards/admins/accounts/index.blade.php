@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Accounts')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Accounts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">Home</a></li>
                        <li class="breadcrumb-item active">Accounts</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Accounts</h3>
                    <a class="btn btn-secondary float-right mr-2" href="{{route('accountTrashed')}}"><i class="fas fa-trash-restore"></i></a>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover data-table4">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Picture</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="viewUser" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStudentLabel">View Student</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>User ID</th>
                                    <td id="uid"></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td id="uname"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td id="uemail"></td>
                                </tr>
                                <tr>
                                    <th>Picture</th>
                                    <td><img id="upicture" class="clickable-image" style="max-width: 100px; max-height: 100px;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
@endsection
