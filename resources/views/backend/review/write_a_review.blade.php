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

        @if(Auth::user()->email_verified_at == null)
            <div class="alert alert-secondary" role="alert">
                Looks like you still have to confirm your account. Any reviews you write won’t be posted until you do.
                Check your inbox and spam folders for a confirmation email, or click here to resend.
            </div>
        @endif
            <h2 class="heading text-primary">Been to these businesses recently?</h2>
        <div class="row">
            @foreach($city_business as $business)
                <div class="col-md-4">
                    <div class="card mb-3 lift">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Avatar -->
                                    <a href="{{ url('business', $business->slug)  }}" class="avatar avatar-4by3">
                                        <img src="{{ asset('backend/assets/img/avatars/profiles/avatar-2.jpg') }}"
                                             alt="..." class="avatar-img rounded">
                                    </a>

                                </div>
                                <div class="col ml-n2">

                                    <!-- Title -->
                                    <h4 class="mb-1">
                                        <a href="{{ url('business', $business->slug)  }}">{{$business->name}}</a>
                                    </h4>

                                    <!-- Text -->

                                    <a href="{{ url('business', $business->slug)  }}" class="small">
                                        <div class="rating text-primary "
                                             data-rate-value="@if(sizeof($business->reviews) > 1){{ floor((($business->reviews->sum('stars')/sizeof($business->reviews))*2)/2 ) }} @else 0 @endif"></div>

                                    </a>


                                </div>

                            </div> <!-- / .row -->
                        </div> <!-- / .card-body -->
                    </div>
                </div>
            @endforeach
        </div>
        <!-- / .row -->

    </div>


@endsection