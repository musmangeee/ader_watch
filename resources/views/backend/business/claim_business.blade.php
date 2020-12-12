@extends('layouts.frontend')

@section('content')
    @include('frontend.partials.default_banner')
    <!-- CARDS -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-6 text-center py-7">

                <h1>Please enter the following details to Verify <span class="text-primary">{{ $business->name }}</span></h1>
                <!-- Form -->
                <form class="" id="wizardSteps" action="{{route('user.store_claim_business')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $business->slug }}" name="business_slug">
                    <div class="form-group">
                        <select name="role" id="" class="form-control" required >
                            <option value="">What is your role in this business?</option>
                            <option value="owner">Owner</option>
                            <option value="employee">Employee</option>
                        </select>

                    </div>
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" placeholder="Username" aria-label="Recipient's username" aria-describedby="basic-addon2" required name="username">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">{{ '@' . preg_replace('#^(http(s)?://)?w{3}\.#', '$1', parse_url($business->url)['host']) }}</span>
                        </div>
                    </div>

                    <button class="btn btn-secondary">Claim {{ $business->name }}</button>

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
