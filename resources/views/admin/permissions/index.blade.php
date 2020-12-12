@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="role">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permissions</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-icon-text">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                Create New Permission
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
                    <h6 class="card-title">Permissions</h6>
                    <p class="card-description">All the permissions are listed here.</p>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Permission Name
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
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>
                                        {{ $permission->id }}
                                    </td>
                                    <td>
                                        {{ $permission->name }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($permission->created_at)->diffForhumans() }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($permission->updated_at)->diffForhumans() }}
                                    </td>
                                    <td>
                                        <form class="d-inline-block" action="{{ route('permissions.destroy',$permission->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn social-btn btn-danger btn-xs">
                                                <i class="mdi mdi-delete-empty"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('permissions.edit',$permission->id) }}" class="btn social-btn btn-warning btn-xs">
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