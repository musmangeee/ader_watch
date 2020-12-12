@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">

            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                 Business
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title">
                               Update Business
                            </h1>

                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
            @if(Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
            @endif
            @if(Session::has('error'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
            @endif

            <!-- Form -->
            <form role="form" action="{{route('business.update',$business->id)}}" method="POST" >
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <!-- Project name -->
                <div class="form-group">

                    <!-- Label  -->
                    <label>
                        Business name
                    </label>

                    <!-- Input -->
                    <input type="text" name="name" value="{{$business->name}}" class="form-control">

                </div>

                <!-- Project description -->
                <div class="form-group">

                    <!-- Label -->
                    <label class="mb-1">
                        description
                    </label>
                    <!-- Textarea -->
                    <textarea name="description" class="form-control">{{$business->description}}</textarea>

                    {{-- <div data-toggle="quill" name="description"></div> --}}

                </div>

                <div class="form-group">

                    <!-- Label -->
                    <label class="mb-1">
                        Message
                    </label>
                    <!-- Textarea -->
                    <textarea name="message" class="form-control">{{$business->message}}</textarea>

                </div>

                <!-- Project tags -->
                <div class="form-group">

                    <!-- Label -->
                    <label>
                        Category
                    </label>

                    <!-- Select -->
                    <select class="form-control" data-toggle="select" name="category_id">
                        <option value="{{$business->category_id}}">{{$business->category->name}}</option>
                        @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->name}} </option>
                        @endforeach
                    </select>

                </div>

                <div class="row">
                    <div class="col-12 col-md-6">

                        <!-- Start date -->
                        <div class="form-group">

                            <!-- Label -->
                            <label>
                                Latitude
                            </label>

                            <!-- Input -->
                            <input type="text" name="latitude" class="form-control" value="{{$business->latitude}}">


                        </div>

                    </div>
                    <div class="col-12 col-md-6">

                        <!-- Start date -->
                        <div class="form-group">

                            <!-- Label -->
                            <label>
                                Longitude
                            </label>

                            <!-- Input -->
                            <input type="text" name="longitude" class="form-control" value="{{$business->longitude}}">


                        </div>

                    </div>
                </div> <!-- / .row -->
                <div class="row">
                    <div class="col-12 col-md-6">

                        <!-- Start date -->
                        <div class="form-group">

                            <!-- Label -->
                            <label>
                                URL
                            </label>

                            <!-- Input -->
                            <input type="url" name="url" class="form-control" value="{{$business->url}}">
                        </div>

                    </div>
                    <div class="col-12 col-md-6">

                        <!-- Start date -->
                        <div class="form-group">

                            <!-- Label -->
                            <label>
                                Hours
                            </label>

                            <!-- Input -->
                            <input type="text" name="hours" class="form-control" value="{{$business->hours}}">


                        </div>

                    </div>
                </div> <!-- / .row -->
                <div class="col-12 col-md-6">

                    <!-- Start date -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>
                            Phone
                        </label>

                        <!-- Input -->
                        <input type="number" name="phone" class="form-control" value="{{$business->phone}}">


                    </div>

                </div>

                <div class="row">

                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <input type="submit" name="submit" value="Update Project" class="btn btn-block btn-primary">

                {{-- <a href="#" class="btn btn-block btn-primary">
                    Create project
                </a> --}}
                <a href="{{route('business.index')}}" class="btn btn-block btn-link text-muted">
                    Cancel this Business
                </a>

            </form>

        </div>
    </div> <!-- / .row -->
</div>

@endsection

