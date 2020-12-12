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
                                <a href="{{ url('my/business') }}" class="nav-link text-dark">For Businesses</a>
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
                                                <img src="{{ auth()->user()->avatar }}" alt="avatar-img rounded-circle"
                                                     width="32" height="32"
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

        </div>

    </header>



    <section>

        <!-- CARDS -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">

                    <!-- Form -->
                    <form class="tab-content py-6" id="wizardSteps" action="{{route('user.business.store')}}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        <div class="tab-pane fade show active" id="wizardStepOne" role="tabpanel"
                             aria-labelledby="wizardTabOne">

                            <!-- Header -->
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                                    <!-- Pretitle -->
                                    <h6 class="mb-4 text-uppercase text-muted">
                                        Step 1 of 3
                                    </h6>

                                    <!-- Title -->
                                    <h1 class="mb-3">
                                        Let’s lookup your business.
                                    </h1>

                                    <!-- Subtitle -->
                                    <p class="mb-5 text-muted">
                                        Your Business may already on AreasGH, If isn't you may add it.
                                    </p>

                                </div>
                            </div> <!-- / .row -->

                            <!-- Team name -->
                            <div class="form-group">

                                <!-- Label -->
                                <label>
                                    City
                                </label>

                                <!-- Input -->
                                <select class="custom-select" data-toggle="select" name="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <!-- Team description -->
                            <div class="form-group">

                                <!-- Label -->
                                <label class="mb-1">
                                    Business Name
                                </label>

                                <input type="text" name="name" class="form-control" required>
                            </div>


                            <!-- Divider -->
                            <hr class="my-5">

                            <!-- Footer -->
                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Button -->
                                    <button class="btn btn-lg btn-white" type="reset">Cancel</button>

                                </div>
                                <div class="col text-center">

                                    <!-- Step -->
                                    <h6 class="text-uppercase text-muted mb-0">Step 1 of 3</h6>

                                </div>
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a class="btn btn-lg btn-primary" data-toggle="wizard"
                                       href="#wizardStepTwo">Continue</a>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="wizardStepTwo" role="tabpanel" aria-labelledby="wizardTabTwo">

                            <!-- Header -->
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                                    <!-- Pretitle -->
                                    <h6 class="mb-4 text-uppercase text-muted">
                                        Step 2 of 3
                                    </h6>

                                    <!-- Title -->
                                    <h1 class="mb-3">
                                        Get started by telling us how customers will reach you
                                    </h1>

                                    <!-- Subtitle -->
                                    <p class="mb-5 text-muted">
                                        Add your business contact information, so customers can reach you.
                                    </p>

                                </div>
                            </div> <!-- / .row -->

                            <div class="form-group">

                                <!-- Label -->
                                <label>
                                    Business Categories
                                </label>

                                <!-- Input -->
                                <select class="form-control" data-toggle="select" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <!-- Team description -->
                            <div class="form-group">

                                <!-- Label -->
                                <label class="mb-1">
                                    Business Phone Number
                                </label>

                                <input type="text" name="phone" class="form-control" placeholder="Business Phone Number"
                                       data-mask="(000) 000-0000">
                            </div>

                            <!-- Team description -->
                            <div class="form-group">

                                <!-- Label -->
                                <label class="mb-1">
                                    Business Website
                                </label>

                                <input type="url" name="url" class="form-control" placeholder="Business Website">
                            </div>

                            <!-- Team description -->
                            <div class="form-group">

                                <!-- Label -->
                                <label class="mb-1">
                                    Business Street Address
                                </label>

                                <input type="text" name="address" class="form-control"
                                       placeholder="Business Street Address">
                            </div>


                            <!-- Starting files -->


                            <!-- Divider -->
                            <hr class="my-5">

                            <!-- Footer -->
                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a class="btn btn-lg btn-white" data-toggle="wizard" href="#wizardStepOne">Back</a>

                                </div>
                                <div class="col text-center">

                                    <!-- Step -->
                                    <h6 class="text-uppercase text-muted mb-0">Step 2 of 3</h6>

                                </div>
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a class="btn btn-lg btn-primary" data-toggle="wizard"
                                       href="#wizardStepThree">Continue</a>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="wizardStepThree" role="tabpanel"
                             aria-labelledby="wizardTabThree">

                            <!-- Header -->
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                                    <!-- Pretitle -->
                                    <h6 class="mb-4 text-uppercase text-muted">
                                        Step 3 of 3
                                    </h6>

                                    <!-- Title -->
                                    <h1 class="mb-3">
                                        Add images to your business.
                                    </h1>

                                    <!-- Subtitle -->
                                    <p class="mb-5 text-muted">
                                        By continuing, you agree to the terms and conditions, and acknowledge our
                                        privacy
                                        policy.
                                    </p>

                                </div>
                            </div> <!-- / .row -->


                            <!-- Divider -->
                            <hr class="mt-5 mb-5">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="gallery row">

                                    </div>
                                    <!-- Team description -->

                                    <div class="input-images"></div>
                                </div>

                            </div> <!-- / .row -->

                            <!-- Divider -->
                            <hr class="my-5">

                            <!-- Footer -->
                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a class="btn btn-lg btn-white" data-toggle="wizard" href="#wizardStepTwo">Back</a>

                                </div>
                                <div class="col text-center">

                                    <!-- Step -->
                                    <h6 class="text-uppercase text-muted mb-0">Step 3 of 3</h6>

                                </div>
                                <div class="col-auto">

                                    <!-- Button -->
                                    <button class="btn btn-lg btn-primary" type="submit">Create</button>

                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
            <!-- / .row -->

        </div>
    </section>


@endsection
<!-- Libs JS -->

@section('script')
    <script>
        $(document).ready(function () {
            $('.input-images').imageUploader();
        })
    </script>
@endsection