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

    <div>
<h2>LIBRARY</h2>
</div>

        @if(Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif
        <div class="row">
        @foreach($data['ads'] as $ads)
                    <div class="col-lg-4 col-sm-6">
                        <div
                           class="card cat-card lift">
                            <div class="ad-price">{{ $ads->package['amount_per_view'] }} USD</div>
                            <!-- Image -->
                            <video src="{{ asset('storage/app/public/'.$ads['video']) }}"
                                   class="card-img-top"></video>
                            <!-- Body -->
                            <div class="card-body text-left">
                                <!-- Heading -->
                                <h2 class="card-title text-dark">
                                    {{ $ads['title'] }}
                                </h2>
                                <p>
                                    @foreach($ads->categories as $cat)
                                        <span class="badge badge-secondary">{{ $cat->name }}</span>
                                    @endforeach
                                </p>
                                <p class="text-secondary font-italic">{{ $ads['description'] }}</p>
                                @if(Auth::user())
                                
                                <a class="btn btn-primary" href="{{ url('view/'.urlencode($ads['id'])) }}">Watch Ad</a>
                                <a class="btn btn-secondary" href="{{ $ads['link'] }}" target="_blank">{{$ads['btn_text']}}</a>
                                
                                @else

                                <a class="btn btn-primary" href="{{route('login')}}">Watch Ad</a>
                                <a class="btn btn-secondary" href="{{route('login')}}" target="_blank">{{$ads['btn_text']}}</a>
                               @endif
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        <!-- / .row -->

    </div>


@endsection