@extends('layouts.frontend')

@section('content')


    @include('frontend.partials.default_banner')

    <!-- HEADER -->
    <div class="header">
        <div class="container">

            <!-- Body -->
            <div class="header-body">
                <div class="row align-items-end">
                    <div class="col">

                        <!-- Pretitle -->
                        <h6 class="header-pretitle">
                            Write Your Review
                        </h6>

                        <!-- Title -->
                        <h1 class="header-title">
                            What is your experience regarding <strong class="text-primary">{{$business->name}}</strong>?
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('user.store.review')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="rate text-primary" data-rate-value=5 style="font-size: 3rem"></div>
                            <input type="hidden" name="review_value" class="review_value">
                            <input type="hidden" name="business_id" value="{{$business->id}}">

                            <div class="form-group">
                                <label for="">Write Your Review</label>
                                <textarea  id="" cols="30" rows="10" class="form-control" name="message" placeholder="What's your experience with {{$business->name}}"></textarea>
                            </div>
                            <div class="input-images mb-3"></div>
                            <button class="btn btn-primary">Post Review</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- / .row -->

    </div>


@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $('.input-images').imageUploader();
            $(".rate").rate({
                update_input_field_name: $(".review_value"),
            });
        });
    </script>
@endsection