@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="role">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-icon-text">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                Create Role
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session()->get('success'))
                <div class="alert alert-fill-success mb-3">
                    {{ session()->get('success') }}
                </div><br/>
            @endif
        </div>
        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Roles</h6>
                    <p class="card-description">All the roles are listed here.</p>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Role Name
                                </th>
                                <th>
                                    Permissions
                                </th>
                                <th>
                                    Created At
                                </th>
                                <th>
                                    Updated At
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>
                                        {{ $role->id }}
                                    </td>
                                    <td>
                                        {{ $role->name }}
                                    </td>
                                    <td>
                                        @foreach($role->permissions()->pluck('name')  as $v)
                                            <label class="badge badge-primary">{{ $v }}</label>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($role->created_at)->diffForhumans() }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($role->updated_at)->diffForhumans() }}
                                    </td>
                                    <td>
                                        <form class="d-inline-block" action="{{ route('roles.destroy',$role->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn social-btn btn-danger btn-xs">
                                                <i class="mdi mdi-delete-empty"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('roles.edit',$role->id) }}" class="btn social-btn btn-warning btn-xs">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection