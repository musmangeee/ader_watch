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
                                New Business Package
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title">
                                Create a new Package
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
            <form class="mb-4" method="POST" action="{{route('packages.store')}}" enctype="multipart/form-data">

            @csrf
                <!-- Project name -->
                <div class="form-group">

                    <!-- Label  -->
                    <label>
                        Package name
                    </label>

                    <!-- Input -->
                    <input type="text" name="name" class="form-control">

                </div>
                <!-- Project name -->
                <div class="form-group">

                    <!-- Label  -->
                    <label>
                        Package Description
                    </label>

                    <!-- Input -->
                    <textarea name="description" class="form-control" rows="5" > </textarea>

                </div>
                <label for="">Package Price</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="price">
                    <div class="input-group-append">
                        <span class="input-group-text">$</span>
                    </div>
                </div>
                <label for="">Price Per View</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount_per_view" step=".10">
                    <div class="input-group-append">
                        <span class="input-group-text">$</span>
                    </div>
                </div>
                <label for="">No of Views</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="total_views">
                    <div class="input-group-append">
                        <span class="input-group-text">Views</span>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <input type="submit" name="submit" value="Create Package" class="btn btn-block btn-primary">

                {{-- <a href="#" class="btn btn-block btn-primary">
                    Create project
                </a> --}}
                <a href="{{route('packages.index')}}" class="btn btn-block btn-link text-muted">

                    Cancel this Package
                </a>

            </form>

        </div>
    </div> <!-- / .row -->
</div>

@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $('.input-images').imageUploader();
        });
    </script>
@endsection

