@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create User</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">

            @foreach ($errors->all() as $error)
                <div class="alert alert-fill-danger" role="alert">
                    <strong>Whoops!</strong>{{ $error }}
                </div>
            @endforeach
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Users Form</h6>
                    <form class="forms-sample" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name"> Name</label>
                            <input type="text" class="form-control" id="name" autocomplete="off"
                                   placeholder="Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" autocomplete="off"
                                   placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" autocomplete="off"
                                   placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" autocomplete="off"
                                   placeholder="Password" name="confirm-password">
                        </div>
                        <div class="form-group">
                            @foreach($roles as $value)
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="roles[]"
                                               value="{{ $value }}">
                                        {{ $value }}
                                        <i class="input-helper"></i></label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection