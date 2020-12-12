@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="role">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users Management</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-icon-text">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                Create New User
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
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Created
                                </th>
                                <th>
                                    Updated
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>{{ $user->updated_at->diffForHumans() }}</td>

                                    <td>
                                        <form class="d-inline-block" action="{{ route('users.destroy',$user->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn social-btn btn-danger btn-xs">
                                                <i class="mdi mdi-delete-empty"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('users.edit',$user->id) }}" class="btn social-btn btn-warning btn-xs">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection