@extends('layouts.admin')

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
                                 Business Category
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title">
                               Update Business Category
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
            <form role="form" action="{{route('business_category.update',$businessCategory->id)}}" method="POST" >
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <!-- Project name -->
                <div class="form-group">

                    <!-- Label  -->
                    <label>
                        Business name
                    </label>

                    <!-- Input -->
                    <input type="text" name="name" value="{{$businessCategory->name}}" class="form-control">

                </div>

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <input type="submit" name="submit" value="Update Category" class="btn btn-block btn-primary">

                {{-- <a href="#" class="btn btn-block btn-primary">
                    Create project
                </a> --}}
                <a href="{{route('businesscategory.index')}}" class="btn btn-block btn-link text-muted">
                    Cancel this Category
                </a>

            </form>

        </div>
    </div> <!-- / .row -->
</div>

@endsection

