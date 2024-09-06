@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Northeatern College | Profile')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img id="profile-picture" class="profile-user-img img-fluid img-circle admin_picture"
                                    src="{{ Auth::user()->picture }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center admin_name">{{ Auth::user()->name }}</h3>
                            <p class="text-muted text-center">Administrator</p>
                            <input type="file" name="admin_image" id="admin_image"
                                style="opacity: 0; height:1px;display:none;">
                            <a href="javascript:void(0)" id="change_picture_btn" class="btn btn-primary btn-block"><b>Change
                                    Picture</b></a>
                        </div>

                    </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal
                                        Information</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change
                                        Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personal">
                                    <form class="form-horizontal" method="POST" action="{{ route('adminUpdateInfo') }}"
                                        id="AdminInfoForm">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="Name"
                                                    value="{{ Auth::user()->name }}" name="name">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Email" value="{{ Auth::user()->email }}" name="email">
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" method="POST" action="{{ route('adminChangePassword') }}" id="changePasswordAdminForm">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password" placeholder="Enter current password" name="oldpassword">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-password"><i class="fa fa-eye"></i></span>
                                                    </div>
                                                </div>
                                                <span class="text-danger error-text oldpassword_error"></span>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="newpassword" placeholder="Enter new password" name="newpassword">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-password"><i class="fa fa-eye"></i></span>
                                                    </div>
                                                </div>
                                                <span class="text-danger error-text newpassword_error"></span>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Confirm New Password</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="cnewpassword" placeholder="Re-enter new password" name="cnewpassword">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-password"><i class="fa fa-eye"></i></span>
                                                    </div>
                                                </div>
                                                <span class="text-danger error-text cnewpassword_error"></span>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection
