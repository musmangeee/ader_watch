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
        <h1 class="heading mb-5">All Ghana Cities (<span class="text-primary">{{ count($cities) }}</span>)</h1>
        <div class="row">
            @foreach($cities as $key => $city)
                <div class="col-md-12 mt-5">
                    <a href="{{ url('search?city='.urlencode($city['name']).'&category=') }}"> <h2 class="text-primary"> {{ $city['name'] }}</h2> </a>
                </div>

                @foreach($city->towns as $k =>  $towns)
                    <div class="col-md-3 mb-3">
                        <span class="text-secondary">{{ $k+1 }}. </span><a
                                href="{{ url('search?city='.urlencode($towns['name']).'&category=') }}"> {{ $towns['name'] }}</a>
                    </div>
                @endforeach
            @endforeach
        </div>
        <!-- / .row -->

    </div>


@endsection