@extends('dashboard.layouts.master')

@section('title', 'New user')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">New user</h3>
                        <a href="{{ route('dashboard.user.index') }}" class="btn btn-sm btn-outline-success" style="position: absolute; bottom: 6px; right: 8px;">back to users</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('dashboard.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-grou">
                                        <label for="name">Name <span class="text-danger">*</span> </label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-grou">
                                        <label for="lastname">Lastname <span class="text-danger">*</span> </label>
                                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="form-grou">
                                        <label for="national_code">Country <span class="text-danger">*</span> </label>
                                        <input type="number" name="national_code" class="form-control" value="{{ old('national_code') }}">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-grou">
                                        <label for="phonenumber">Phone number <span class="text-danger">* (10 digits)</span> </label>
                                        <input type="number" name="phonenumber" class="form-control" value="{{ old('phonenumber') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-grou">
                                        <label for="email">Email <span class="text-danger">*</span> </label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-grou">
                                        <label for="gender">Gender <span class="text-danger">*</span> </label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="" selected disabled hidden>select the gender</option>
                                            <option {{ old('gender') == config('constants.users.gender.male') ? 'selected' : '' }} value="{{ config('constants.users.gender.male') }}">Male</option>
                                            <option {{ old('gender') == config('constants.users.gender.female') ? 'selected' : '' }} value="{{ config('constants.users.gender.female') }}">female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-grou">
                                        <label for="image">Image <span class="text-danger">*</span> </label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-grou">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="default password: P@sssw0rd">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-grou mt-3">
                                        <button class="btn btn-success btn-block">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>
@endsection
