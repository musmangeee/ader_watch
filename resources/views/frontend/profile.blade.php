@extends('layouts.frontend')

@section('content')

    @include('frontend.partials.default_banner')

    <div class="container-fluid px-0">
        <img src="{{ asset('backend/assets/img/covers/profile-cover-1.jpg') }}" class="header-img-top" alt="...">
    </div>
    <div class="container">
        <!-- HEADER -->
        <div class="header">

            <!-- Image -->


            <div class="container-fluid">

                <!-- Body -->
                <div class="header-body mt-n5 mt-md-n6">
                    <div class="row align-items-end">
                        <div class="col-auto">

                            <!-- Avatar -->
                            <div class="avatar avatar-xxl header-avatar-top">

                                @if($user['avatar'])
                                    <img src=" {{ $user['avatar'] }}" class="avatar-img rounded-circle border border-4 border-body"
                                         style="margin-right: 8px;; border-radius: 50%">
                                @else
                                    <span class="avatar-title rounded-circle border border-4 border-body">@php echo explode(" ", $user['name'])[0][0] . explode(" ", $user['name'])[1][0];  @endphp</span>
                                @endif
                            </div>

                        </div>
                        <div class="col mb-3 ml-n3 ml-md-n2">

                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                Members
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title">
                                {{ $user['name'] }}
                            </h1>

                        </div>
                        <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">

                            <!-- Button -->
                            <a href="#!" class="btn btn-primary d-block d-md-inline-block lift">
                                Subscribe
                            </a>

                        </div>
                    </div> <!-- / .row -->
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Nav -->
                            <ul class="nav nav-tabs nav-overflow header-tabs">
                                <li class="nav-item">
                                    <a href="profile-posts.html" class="nav-link active">
                                        Posts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profile-groups.html" class="nav-link">
                                        Groups
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profile-projects.html" class="nav-link">
                                        Projects
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profile-files.html" class="nav-link">
                                        Files
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profile-subscribers.html" class="nav-link">
                                        Subscribers
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div> <!-- / .header-body -->

            </div>
        </div>

        <!-- CONTENT -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-8">

                @foreach($user->reviews->random(4) as $review)

                    <!-- Card -->

                        <div class="card review-card">
                            @if(count($review->images) == 1)
                                <img src="{{ asset('storage/app/public/' . $review->images[0]->name) }}" alt="..." class="card-img-top">
                            @elseif(count($review->images) > 1)
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">
                                        @foreach($review->images as $key => $image)
                                            <div class="carousel-item card-img-top @if(($key-1)==0) active @endif"
                                                 style="background-image: url('{{ asset('storage/app/public/' .$image->name) }}');">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                        @endif
                        <!-- Body -->
                            <div class="card-body">
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
                                                {{ $user['name'] }}
                                            </h4>

                                            <!-- Time -->
                                            <p class="card-text small text-muted">
                                                <span class="fe fe-clock"></span>
                                                <time datetime="2018-05-24">{{ \Carbon\Carbon::parse($review->created_at)->diffForhumans() }}</time>
                                            </p>

                                        </div>
                                        <div class="col-auto">

                                            <!-- Dropdown -->
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-ellipses dropdown-toggle" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                                        <div class="rating text-primary " data-rate-value="{{ $review->stars }}"></div>

                                        <p class="my-3 font-weight-bold font-italic font-size-lg">
                                            " {{ $review->text }}"
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer card-footer-boxed">
                                <a href="{{ url('business',$review->business['slug']) }}">
                                    <h4>{{ $review->business['name'] }}</h4>
                                </a>
                            </div>
                        </div>


                    @endforeach

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
                                                Reviews
                                            </h5>

                                        </div>
                                        <div class="col-auto">

                                            <!-- Time -->
                                            <time class="small text-muted" datetime="1988-10-24">
                                                {{ count($user->reviews) }}
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
                                                {{ \Carbon\Carbon::parse($user['created_at'])->diffForhumans() }}
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
                                                {{ $user->city['name'] }}
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
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".rating").rate({
                update_input_field_name: $(".review_value"),
            });
            $('.carousel').carousel({
                interval: 2000
            })
        });
    </script>
@endsection