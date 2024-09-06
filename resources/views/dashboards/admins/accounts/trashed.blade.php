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
                        <li class="breadcrumb-item active">Restore Deleted Accounts</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Restore Deleted Accounts</h3>
                    <a class="btn btn-secondary float-right mr-2" href="{{route('accounts.index')}}"><i
                        class="fas fa-arrow-left"></i></a>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover data-table5">
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


 
@endsection
