@extends('layouts.backend')

@section('content')

    <div class="header">

        <!-- Image -->
        <img src="{{ asset('backend/assets/img/covers/profile-cover-1.jpg') }}" class="header-img-top" alt="...">

        <div class="container-fluid">

            <!-- Body -->
            <div class="header-body mt-n5 mt-md-n6">
                <div class="row align-items-end">
                    <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar avatar-xxl header-avatar-top">
                            <img src="@if(auth()->user()->avatar) {{ auth()->user()->avatar }} @else {{ asset('backend/assets/img/avatars/profiles/avatar-1.jpg') }} @endif" alt="..." class="avatar-img rounded-circle border border-4 border-body">
                        </div>

                    </div>
                    <div class="col mb-3 ml-n3 ml-md-n2">

                        <!-- Pretitle -->
                        <h6 class="header-pretitle">
                            Members
                        </h6>

                        <!-- Title -->
                        <h1 class="header-title">
                            {{ Auth::user()->name }}
                        </h1>

                    </div>
                    <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">

                        <!-- Button -->
                        <a href="#!" class="btn btn-primary d-block d-md-inline-block lift">
                            Edit Profle
                        </a>

                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .header-body -->

        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-8">

                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">

                        <!-- Card -->
                        <div class="card">

                            <!-- Image -->
                            <a href="project-overview.html">
                                <img src="{{ asset('backend/assets/img/avatars/projects/project-1.jpg') }}" alt="..." class="card-img-top">
                            </a>

                            <!-- Body -->
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">

                                            <!-- Avatar -->
                                            <a href="#!" class="avatar">
                                                <img src="{{ asset('backend/assets/img/avatars/profiles/avatar-1.jpg') }}" alt="..." class="avatar-img rounded-circle">
                                            </a>

                                        </div>
                                        <div class="col ml-n2">

                                            <!-- Title -->
                                            <h4 class="mb-1">
                                                Dianna Smiley
                                            </h4>

                                            <!-- Time -->
                                            <p class="card-text small text-muted">
                                                <span class="fe fe-clock"></span> <time datetime="2018-05-24">4hr ago</time>
                                            </p>

                                        </div>
                                        <div class="col-auto">

                                            <!-- Dropdown -->
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe fe-more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#!" class="dropdown-item">
                                                        Action
                                                    </a>
                                                    <a href="#!" class="dropdown-item">
                                                        Another action
                                                    </a>
                                                    <a href="#!" class="dropdown-item">
                                                        Something else here
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                            <p class="my-3 font-weight-bold font-italic font-size-lg">
                                                " I've been working on shipping the latest version of Launchday. The story I'm trying to focus on is something like "You're launching soon and need to be 100% focused on your product. Don't lose precious days designing, coding, and testing a product site. Instead, build one in minutes."
                                            </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer card-footer-boxed">
                                <h3>Business Name Here</h3>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-12 col-xl-4">

                <!-- Card -->
                <div class="card">
                    <div class="card-body">

                        <!-- List group -->
                        <div class="list-group list-group-flush my-n3">
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col">

                                        <!-- Title -->
                                        <h5 class="mb-0">
                                            Birthday
                                        </h5>

                                    </div>
                                    <div class="col-auto">

                                        <!-- Time -->
                                        <time class="small text-muted" datetime="1988-10-24">
                                            10/24/88
                                        </time>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col">

                                        <!-- Title -->
                                        <h5 class="mb-0">
                                            Joined
                                        </h5>

                                    </div>
                                    <div class="col-auto">

                                        <!-- Time -->
                                        <time class="small text-muted" datetime="2018-10-28">
                                            10/24/18
                                        </time>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col">

                                        <!-- Title -->
                                        <h5 class="mb-0">
                                            Location
                                        </h5>

                                    </div>
                                    <div class="col-auto">

                                        <!-- Text -->
                                        <small class="text-muted">
                                            Los Angeles, CA
                                        </small>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col">

                                        <!-- Title -->
                                        <h5 class="mb-0">
                                            Website
                                        </h5>

                                    </div>
                                    <div class="col-auto">

                                        <!-- Link -->
                                        <a href="#!" class="small">
                                            themes.getbootstrap.com
                                        </a>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div> <!-- / .row -->
    </div>


@endsection
