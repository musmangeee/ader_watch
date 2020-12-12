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
                                Category
                            </h1>

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <a href="{{route('business_category.create')}}" class="btn btn-primary lift">
                                Create New Category
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
                            <th>Image</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($businessCategory as $item)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td><i class="{{ $item->icon }} pr-3"></i>{{$item->name}}</td>
                                <td>



                                        <img src="{{ asset('storage/app/public/'.$item['image']) }}" class="avatar avatar-sm rounded">


                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{route('business_category.edit', $item->id)}}"
                                       class="btn btn-warning btn-sm lift"><i class="fe fe-edit"></i></a>
                                    <form action="{{ route('business_category.destroy', $item->id)}}" method="post"
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

