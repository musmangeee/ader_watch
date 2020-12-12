@extends('layouts.frontend')

@section('content')


    <!-- CARDS -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

                <!-- Form -->
                <form class="tab-content py-6" id="wizardSteps" action="{{route('user.business.store')}}" method="POST"
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

                            <input type="text" name="business_name" class="form-control" required>
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
                    <div class="tab-pane fade" id="wizardStepThree" role="tabpanel" aria-labelledby="wizardTabThree">

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
                                    By continuing, you agree to the terms and conditions, and acknowledge our privacy
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


@endsection



@section('script')
    <script>
        $(document).ready(function () {
            $('.input-images').imageUploader();
        })
    </script>
@endsection
