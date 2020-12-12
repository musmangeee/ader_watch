@extends('layouts.frontend')

@section('style')
    <style>
        .rating {
            font-size: 1rem;
        }
    </style>
@endsection

@section('content')

    @include('frontend.partials.default_banner')



    <!-- CARDS -->
    <div class="container mt-5">


        @if(Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif
        <div class="row">
            <div class="col-md-8">

                <!-- Value  -->


            </div>
            <div class="col-md-4">


            </div>
        </div>
        <!-- / .row -->

    </div>


@endsection