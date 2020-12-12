<!doctype html>
<html lang="en">

@include('backend.partials.head')

<body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-xl-4 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                Sign up
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                Free access to our dashboard.
            </p>

            @if (Session::has('message'))
                <div class="alert alert-secondary">{{ Session::get('message') }}</div>
        @endif
            <!-- Form -->
            <form method="POST" action="{{ route('signup') }}">
                @csrf
                <div class="form-group">

                    <!-- Input -->
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full name">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                    @enderror


                </div>

                <!-- Email address -->
                <div class="form-group">


                    <!-- Input -->
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <select class="custom-select signup_city" data-toggle="select" name="city_id" required>
                        @foreach($cities as $city)
                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group signup_town">
                    <select class="custom-select " data-toggle="select" name="town_id" required>

                    </select>

                </div>


                <div class="form-group">
                    <!-- Input -->
                    <input type="text" class="form-control" name="address" autocomplete="off" placeholder="Street Address" >
                </div>

                <!-- Password -->
                <div class="form-group">



                    <!-- Input group -->
                    <div class="input-group input-group-merge">

                        <!-- Input -->
                        <input type="password" class="form-control form-control-appended" name="password" placeholder="Password">

                        <!-- Icon -->
                        <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fe fe-eye"></i>
                                </span>
                        </div>

                    </div>
                </div>

                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3">
                    Sign up
                </button>

                <!-- Link -->
                <div class="text-center">
                    <small class="text-muted text-center">
                        Already have an account? <a href="{{route('login')}}">Log in</a>.
                    </small>
                </div>

                <a href="{{ route('login.provider', 'google') }}"
                   class="btn btn-white mt-4 w-100 border-light"> <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="" class="mr-3">{{ __('Continue with Google') }}</a>

            </form>

        </div>
    </div> <!-- / .row -->
</div> <!-- / .container -->

<!-- JAVASCRIPT
================================================== -->
<!-- Libs JS -->
@include('backend.partials.scripts')


</body>

</html>