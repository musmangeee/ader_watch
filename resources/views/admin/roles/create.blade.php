@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Role</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-fill-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Basic Form</h6>
                    <form class="forms-sample" method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" class="form-control" id="role_name" autocomplete="off" placeholder="Role Name" name="role_name">
                        </div>
                        <div class="form-group">
                        @foreach($permission as $value)
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $value->id }}">
                                        {{ $value->name }}
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