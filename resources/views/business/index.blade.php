@extends('layouts.frontend')

@section('content')

    @include('frontend.partials.business_banner')

    <!-- CARDS -->
    <div class="container">

        @if(Auth::user()->business->status == 0)
            <div class="alert alert-secondary mt-4" role="alert">
                Thank you for registering your business with Ader! Your Business is currently under review, you will be notified once your business will be verified!
            </div>
        @endif

        <div class="row">
            <div class="col-12 col-lg-6 col-xl">

                <!-- Value  -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h6 class="text-uppercase text-muted mb-2">
                                    Total Views
                                </h6>

                                <!-- Heading -->
                                <span class="h2 mb-0">
                                  0
                              </span>

                            </div>
                            <div class="col-auto">

                                <!-- Icon -->
                                <span class="h2 fe fe-star text-muted mb-0"></span>

                            </div>
                        </div>
                        <!-- / .row -->
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

                <!-- Hours -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h6 class="text-uppercase text-muted mb-2">
                                    Total Videos
                                </h6>

                                <!-- Heading -->
                                <span class="h2 mb-0">
                                  0
                              </span>

                            </div>
                            <div class="col-auto">

                                <!-- Icon -->
                                <span class="h2 fe fe-image text-muted mb-0"></span>

                            </div>
                        </div>
                        <!-- / .row -->
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

                <!-- Hours -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h6 class="text-uppercase text-muted mb-2">
                                    Total Videos
                                </h6>

                                <!-- Heading -->
                                <span class="h2 mb-0">
                                  {{ sizeof($data['ads']) }}
                              </span>

                            </div>
                            <div class="col-auto">

                                <!-- Icon -->
                                <span class="h2 fe fe-image text-muted mb-0"></span>

                            </div>
                        </div>
                        <!-- / .row -->
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

                <!-- Time -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h6 class="text-uppercase text-muted mb-2">
                                    Reviews
                                </h6>

                                <!-- Heading -->
                                <span class="h2 mb-0">
                                  2:37
                              </span>

                            </div>
                            <div class="col-auto">

                                <!-- Icon -->
                                <span class="h2 fe fe-clock text-muted mb-0"></span>

                            </div>
                        </div>
                        <!-- / .row -->
                    </div>
                </div>

            </div>
        </div>
        <!-- / .row -->
    </div>


@endsection