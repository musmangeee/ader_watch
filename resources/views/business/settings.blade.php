@extends('layouts.frontend')


@section('style')
    <style>
        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: #d32323 !important;
            border-color: #d32323 !important;
        }
    </style>
@endsection

@section('content')

    @include('frontend.partials.business_banner')
    <div class="header">

        <!-- Image -->
        <img src="{{ asset('backend/assets/img/covers/profile-cover-1.jpg') }}" class="header-img-top" alt="...">

        <div class="container">

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
                </div> <!-- / .row -->
            </div> <!-- / .header-body -->

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><i class="fa fa-user pr-3"></i>Account Information</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="fa fa-key pr-3"></i> Password</a>
                            <a class="list-group-item list-group-item-action" id="list-business-list" data-toggle="list" href="#list-business" role="tab" aria-controls="business"><i class="fa fa-shopping-bag pr-3"></i> Business Details </a>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Name</label>
                                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="text" class="form-control" value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary w-100" type="submit">Updated Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Current Password</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">New Password</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Enter Password Again</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <button class="btn btn-primary w-100" type="submit">Updated Password</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="list-business" role="tabpanel" aria-labelledby="list-business-list">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Business Name</label>
                                                        <input type="text" class="form-control" value="{{ Auth::user()->business->name }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Business Phone</label>
                                                        <input type="text" class="form-control" value="{{Auth::user()->business->phone}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Business Website</label>
                                                        <input type="text" class="form-control" value="{{ Auth::user()->business->url }}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <button class="btn btn-primary w-100" type="submit">Update Details</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>


@endsection
