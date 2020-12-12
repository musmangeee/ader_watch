@extends('layouts.frontend')

@section('content')

    @include('frontend.partials.default_banner')

    <div class="container mt-5">
        <div class="card-columns">
            @foreach($reviews as $review)

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
                                            {{ Auth::user()->name }}
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