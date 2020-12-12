@extends('layouts.backend')

@section('style')
    <style>
        .avatar-business {
            width: 12rem;
            height: 12rem;
        }

        .rating {
            font-size: 2rem;
        }
    </style>
@endsection
@section('content')

    <!-- HEADER -->
    <div class="header">
        <div class="container-fluid">

            <!-- Body -->
            <div class="header-body">
                <div class="row align-items-end">
                    <div class="col">

                        <!-- Pretitle -->
                        <h6 class="header-pretitle">
                            Overview
                        </h6>

                        <!-- Title -->
                        <h1 class="header-title">
                            Search For Business
                        </h1>

                    </div>

                </div>
                <!-- / .row -->
            </div>
            <!-- / .header-body -->

        </div>
    </div>
    <!-- / .header -->

    <!-- CARDS -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <form action="{{route('search.business')}}" method="GET">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search For" aria-label=""
                                       aria-describedby="basic-addon1" name="keywords" required>

                                <select class="form-control" name="city" required>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary rounded-right" type="submit">Search Business</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                @if(isset($native_businesses))
                    <div class="header mt-md-5">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h2 class="header-title">
                                        Business Near You
                                    </h2>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                    @foreach ($native_businesses as $result)
                        <div class="card">
                            <div class="card-body">

                                <div class="row align-items-center">
                                    <div class="col-auto">

                                        <!-- Avatar -->
                                        <a href="profile-posts.html" class="avatar avatar-xxl avatar-5by3 avatar-business">

                                            @if(count($result->images)> 0)
                                            <img src="{{ asset('storage/'.$result->images[0]->name) }}"
                                                 alt="..."
                                                 class="avatar-img rounded ">
                                                @else
                                                <img src="{{ asset('backend/assets/img/avatars/profiles/avatar-2.jpg') }}"
                                                     alt="..."
                                                     class="avatar-img rounded ">
                                                @endif

                                        </a>

                                    </div>
                                    <div class="col ml-n2">

                                        <!-- Title -->
                                        <h3 class="mb-1">
                                            <a href="profile-posts.html">{{$result->name}}</a>
                                        </h3>

                                        <a href="{{ url('write_a_review/'. $result->id) }}">
                                            <div class="rating text-primary " data-rate-value="@if(sizeof($result->reviews) > 1){{ floor((($result->reviews->sum('stars')/sizeof($result->reviews))*2)/2 ) }} @else 0 @endif"></div>
                                        </a>
                                        <div class="badge badge-secondary">{{ sizeof($result->reviews) }} Reviews Total</div>
                                        <p class="text-secondary">{{$result->category['name']}}</p>




                                    </div>
                                    <div class="col-auto text-right">
                                        <!-- Text -->
                                        <p class="small text-muted mb-1">
                                            {{$result->phone}}
                                        </p>
                                        <!-- Text -->
                                        <p class="small text-muted mb-1">
                                            {{$result->city->name}}
                                        </p>
                                        <!-- Text -->
                                        <p class="small text-muted mb-1">
                                            {{$result->address}}
                                        </p>

                                    </div>

                                </div> <!-- / .row -->


                            </div> <!-- / .card-body -->
                        </div>
                    @endforeach
                @endif
                @if(isset($other_businesses))
                    <div class="header mt-md-5">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Title -->
                                    <h2 class="header-title">
                                        Recommended Business
                                    </h2>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                    @foreach ($other_businesses as $result)
                        <div class="card">
                            <div class="card-body">

                                <div class="row align-items-center">
                                    <div class="col-auto">

                                        <!-- Avatar -->
                                        <a href="profile-posts.html" class="avatar avatar-xxl avatar-5by3 avatar-business">

                                            <img src="{{ asset('backend/assets/img/avatars/profiles/avatar-2.jpg') }}"
                                                 alt="..."
                                                 class="avatar-img rounded ">

                                        </a>

                                    </div>
                                    <div class="col ml-n2">

                                        <!-- Title -->
                                        <h3 class="mb-1">
                                            <a href="profile-posts.html">{{$result->name}}</a>
                                        </h3>

                                        <a href="{{ route('write_a_review', $result->id) }}">
                                            <div class="rating text-primary " data-rate-value="{{ floor((($result->reviews->sum('stars')/sizeof($result->reviews))*2)/2 ) }}"></div>
                                        </a>
                                        <span class="badge badge-secondary">{{ sizeof($result->reviews) }} Reviews Total</span>

                                        <p class="text-secondary">{{$result->category['name']}}</p>




                                    </div>
                                    <div class="col-auto text-right">
                                        <!-- Text -->
                                        <p class="small text-muted mb-1">
                                            {{$result->phone}}
                                        </p>
                                        <!-- Text -->
                                        <p class="small text-muted mb-1">
                                            {{$result->city->name}}
                                        </p>
                                        <!-- Text -->
                                        <p class="small text-muted mb-1">
                                            {{$result->address}}
                                        </p>

                                    </div>

                                </div> <!-- / .row -->


                            </div> <!-- / .card-body -->
                        </div>
                    @endforeach
                @endif
                @if(isset($search_results))
                    <div class="header mt-md-5">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Pretitle -->
                                    <h6 class="header-pretitle">
                                        Results
                                    </h6>

                                    <!-- Title -->
                                    <h1 class="header-title">
                                        Search Results For: <span class="text-primary"></span>
                                    </h1>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                    @foreach ($search_results as $result)
                    <div class="card">
                        <div class="card-body">

                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Avatar -->
                                    <a href="profile-posts.html" class="avatar avatar-xxl avatar-5by3 avatar-business">

                                        <img src="{{ asset('backend/assets/img/avatars/profiles/avatar-2.jpg') }}"
                                             alt="..."
                                             class="avatar-img rounded ">

                                    </a>

                                </div>
                                <div class="col ml-n2">

                                    <!-- Title -->
                                    <h3 class="mb-1">
                                        <a href="profile-posts.html">{{$result->name}}</a>
                                    </h3>

                                    <a href="{{ route('write_a_review', $result->id) }}">
                                        <div class="rating text-primary " data-rate-value="{{ floor((($result->reviews->sum('stars')/sizeof($result->reviews))*2)/2 ) }}"></div>
                                    </a>

                                    <span class="badge badge-secondary">{{ sizeof($result->reviews) }} Reviews Total</span>
                                    <p class="text-secondary">{{$result->category['name']}}</p>




                                </div>
                                <div class="col-auto text-right">
                                    <!-- Text -->
                                    <p class="small text-muted mb-1">
                                        {{$result->phone}}
                                    </p>
                                    <!-- Text -->
                                    <p class="small text-muted mb-1">
                                        {{$result->city->name}}
                                    </p>
                                    <!-- Text -->
                                    <p class="small text-muted mb-1">
                                        {{$result->address}}
                                    </p>

                                </div>

                            </div> <!-- / .row -->


                        </div> <!-- / .card-body -->
                    </div>
                @endforeach
                @endif
            </div>
        </div>
        <!-- / .row -->

    </div>


@endsection


@section('script')
    <script>
        $(document).ready(function () {
            $(".rating").rate({
                update_input_field_name: $(".review_value"),
            });
        });
    </script>
@endsection