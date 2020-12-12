@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <div class="container-fluid">

                <!-- Body -->
                <div class="header-body">
                    <div class="row align-items-end">
                        <div class="col">

                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                Overview
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title">
                                Packages
                            </h1>

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <a href="{{route('packages.create')}}" class="btn btn-primary lift">
                                Create New Package
                            </a>

                        </div>
                    </div> <!-- / .row -->
                </div> <!-- / .header-body -->

            </div>
        </div>
        @if(Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif

        <div class="card">
            <div class="card-body">

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table text-secondary">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Amount/View</th>
                            <th>Total Views</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($packages as $key =>  $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->amount_per_view }}</td>
                                <td>{{ $item->total_views }}</td>
                                <td>
                                    <a href="{{route('packages.edit', $item->id)}}"
                                       class="btn btn-warning btn-sm lift"><i class="fe fe-edit"></i></a>
                                    <form action="{{ route('packages.destroy', $item->id)}}" method="post"
                                          class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm lift   " type="submit"><i class="fe fe-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

