@extends('layouts.frontend')


@section('content')
    @include('frontend.partials.default_banner')



    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="header-title business-title mb-0">{{ $business->name }}
                        @if($business->status != 0)
                            <a href="" class="text-secondary h4 font-weight-light">Claimed</a>
                        @else
                            <a href="" class="text-secondary h4 font-weight-light" data-toggle="tooltip"
                               data-placement="top"
                               title="This business has not yet been claimed by the owner or a representative."><i
                                        class="fa fa-info-circle pr-1"></i>Un Claimed</a>
                        @endif
                    </h1>
                    <div class="row">
                        <div class="col-auto">
                            <a href="{{ url('write_a_review/'. $business->id) }}">
                                <div class="rating text-primary "
                                     data-rate-value="@if(sizeof($business->reviews) > 1){{ floor((($business->reviews->sum('stars')/sizeof($business->reviews))*2)/2 ) }} @else 0 @endif"></div>
                            </a>
                        </div>
                        <div class="col text-secondary total-reviews">
                            {{ sizeof($business->reviews) }} Reviews Total
                        </div>
                    </div>
                    <p class="text-secondary">{{$business->category['name']}}</p>

                    <a href="{{ url('review', $business->slug) }}" class="btn btn-primary mr-3">
                        <i class="fa fa-star pr-2"></i> Write A Review
                    </a>
                    <a href="" class="btn btn-outline-secondary">
                        <i class="fa fa-tag pr-2"></i> Save
                    </a>

                    <hr>
                    <h2 class="mt-5">About {{ $business->name }}</h2>
                    <h3>Description</h3>
                    <p class="text-secondary">{{ $business->description }}</p>
                    <hr>
                    <h2 class="mt-5">What People Say About {{ $business->name }}</h2>
                    @foreach($business->reviews as $review)
                        <div class="card">
                            <div class="card-body">

                                <!-- Header -->
                                <div class="mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">

                                            <!-- Avatar -->
                                            <a href="{{ url('user', $review->user['id']) }}" class="avatar">
                                                <img src="{{ asset('backend/assets/img/avatars/profiles/avatar-1.jpg') }}"
                                                     alt="..." class="avatar-img rounded-circle">
                                            </a>

                                        </div>
                                        <div class="col ml-n2">

                                            <a href="{{ url('user', $review->user['id']) }}">
                                                <!-- Title -->
                                                <h4 class="mb-1">
                                                    {{ $review->user['name'] }}
                                                </h4>
                                            </a>
                                            <!-- Time -->
                                            <p class="card-text small text-muted">
                                                <span class="fe fe-clock"></span>
                                                <time datetime="2018-05-24">{{ \Carbon\Carbon::parse($review->created_at)->diffForhumans() }}</time>
                                            </p>

                                        </div>
                                        <div class="col-auto">

                                            <div class="rating text-primary "
                                                 data-rate-value="{{ $review->stars }}"></div>

                                        </div>
                                    </div> <!-- / .row -->
                                </div>

                                <!-- Text -->

                                <p class="my-3">
                                    " {{ $review->text }}"
                                </p>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4 mt-n5">
                    <div class="sticky-top pt-5">
                        <div class="card">
                            <div class="card-body">

                                <!-- List group -->
                                <div class="list-group list-group-flush my-n3">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">

                                                <!-- Title -->
                                                <h5 class="mb-0">
                                                    <i class="fa fa-external-link"></i>
                                                </h5>

                                            </div>
                                            <div class="col-auto">

                                                <a href="{{ $business->url }}" target="_blank">
                                                    {{ $business->url }}
                                                </a>


                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">

                                                <!-- Title -->
                                                <h5 class="mb-0">
                                                    <i class="fa fa-phone"></i>
                                                </h5>

                                            </div>
                                            <div class="col-auto">

                                                <!-- Time -->
                                                <span class="small text-muted">
                                                {{ $business->phone }}
                                            </span>

                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">

                                                <!-- Title -->
                                                <h5 class="mb-0">
                                                    <i class="fa fa-store"></i>
                                                </h5>

                                            </div>
                                            <div class="col-auto">


                                                <!-- Time -->
                                                <time class="small text-muted" datetime="1988-10-24">
                                                    {{ \Carbon\Carbon::parse($business->created_at)->diffForhumans() }}
                                                </time>

                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        @if($business->status == 0)
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="h1 fa fa-store-alt text-primary"></i>
                                    <h4>Is this your business?</h4>
                                    <p>Claim your business to immediately update business information, respond to reviews, and more!</p>
                                    <a href="{{ url('claim_business', $business->slug) }}" class="btn btn-white">
                                        Claim This Business
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection
<!-- Libs JS -->