@extends('layouts.frontend')


@section('style')
    <style>
        .areasgh-hero {

            height: 60vh
        }

        .navbar-brand-img, .navbar-brand > img {
            max-height: 2.5rem;
        }

        .input-group {
            border-radius: .375rem !important;
            background-color: #fff;
            overflow: hidden;
            box-shadow: 0 2px 18px rgba(0, 0, 0, .15);
        }

        .input-group .select2-container {
            flex: 1 1 0%;
            border-radius: 0;
        }

        .input-group .form-control {
            border-radius: 0;
            border: 0;

            border-left: 1px solid #EAEAEA;
        }


        .rating {
            font-size: 2rem;
        }

        .total-reviews {

            line-height: 48px;
            padding: 0;

        }

    </style>

@endsection



@section('content')
    <header class="w-100 pt-3 border-bottom">
        <div class="container">
            <nav class="navbar navbar-expand-xl navbar-light mb-2 bg-transparent border-0">
                <div class="container-fluid">

                    <!-- Brand -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('frontend/img/logos/logo-2.png') }}" alt="">
                    </a>
                    <ul class="navbar-nav mr-auto ml-5">
                        <li class="nav-item">
                            <a href="{{route('search.business')}}" class="nav-link text-dark">Write A Review</a>
                        </li>
                    </ul>
                    <!-- Toggler -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Nav -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item pr-lg-2">
                                <a href="{{route('search.business')}}" class="nav-link text-dark">For Businesses</a>
                            </li>
                            <li class="nav-item pr-lg-3">
                                <a href="{{route('search.business')}}" class="nav-link text-dark">Write A Review</a>
                            </li>

                            @guest


                                <li class="nav-item">
                                    <a href="{{route('login')}}" class="nav-link">Login</a>
                                </li>
                                <li class="nav-item ml-lg-4">
                                    <a href="{{route('signup')}}" class="btn btn-primary px-4">Sign Up</a>

                                </li>

                            @else
                                <li class="nav-item dropdown">

                                    <a class="nav-link dropdown-toggle  text-dark" href="#" id="navbarDropdownMenuLink5"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if(auth()->user()->avatar)
                                            <div class="avatar avatar-sm">
                                                <img src="{{ auth()->user()->avatar }}" alt="avatar-img rounded-circle" width="32" height="32"
                                                     style="margin-right: 8px;">
                                            </div>

                                        @endif
                                        {{ explode(' ', auth()->user()->name, 2)[0] }} <span class="caret"></span>

                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ url('home') }}">Profile</a></li>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>

                                    </ul>

                                </li>
                            @endguest
                        </ul>

                    </div>

                </div>
            </nav>
            <div class="row h-100">
                <form action="{{route('search')}}" method="GET" class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search For" aria-label=""
                               aria-describedby="basic-addon1" name="keywords">

                        <select class="form-control" name="category" required="" data-toggle="select">
                            <option value="">Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}" @if($searched_category == $category->name) selected @endif >{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="city" required="" data-toggle="select">
                            @foreach($cities as $city)
                                <option value="{{ $city->name }}" @if($pref_city ==$city->name) selected @endif><i
                                            class="fe fe-check-circle"></i>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-prepend">
                            <button class="btn btn-primary rounded-right" type="submit"><i
                                        class="fe fe-search mx-3"></i></button>
                        </div>
                    </div>


                </form>
                <ul class="nav mt-2 mb-4 text">
                    @for($a = 0; $a<4; $a++)
                        <li class="nav-item">
                            <a class="nav-link text-secondary"
                               href="{{ url('search?category='.urlencode($pref_categories[$a]).'&location='. $pref_city) }}">
                                {{ $pref_categories[$a] }}</a>
                        </li>
                    @endfor
                </ul>
            </div>

        </div>

    </header>



    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="header-title mb-0">{{ $business->name }}</h1>
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

                    <a href="" class="btn btn-primary mr-3">
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
                                            <a href="#!" class="avatar">
                                                <img src="{{ asset('backend/assets/img/avatars/profiles/avatar-1.jpg') }}"
                                                     alt="..." class="avatar-img rounded-circle">
                                            </a>

                                        </div>
                                        <div class="col ml-n2">

                                            <!-- Title -->
                                            <h4 class="mb-1">
                                                {{ $review->user['name'] }}
                                            </h4>

                                            <!-- Time -->
                                            <p class="card-text small text-muted">
                                                <span class="fe fe-clock"></span> <time datetime="2018-05-24">{{ \Carbon\Carbon::parse($review->created_at)->diffForhumans() }}</time>
                                            </p>

                                        </div>
                                        <div class="col-auto">

                                            <div class="rating text-primary " data-rate-value="{{ $review->stars }}"></div>

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
                        <div class="card"><div class="card-body">

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

                        </div></div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection
<!-- Libs JS -->

@section('script')

    <script>
        $(document).ready(function () {
            $(".rating").rate({
                update_input_field_name: $(".review_value"),
            });
        });
    </script>
@endsection
