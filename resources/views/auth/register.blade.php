<!doctype html>
<html lang="en">

<!-- Mirrored from dashkit.goodthemes.co/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 May 2020 10:14:21 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
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

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                     <div class="form-group">

                         <!-- Label -->
                         <label>
                            Name
                         </label>

                         <!-- Input -->
                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter full name">

                         @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror


                     </div>

                    <!-- Email address -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>
                            Email Address
                        </label>

                        <!-- Input -->
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <!-- Password -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>
                            Password
                        </label>

                        <!-- Input group -->
                        <div class="input-group input-group-merge">

                            <!-- Input -->
                            <input type="password" class="form-control form-control-appended" name="password" placeholder="Enter your password">

                            <!-- Icon -->
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fe fe-eye"></i>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">

                        <!-- Label -->
                        <label>
                            Confirm Password
                        </label>

                        <!-- Input group -->
                        <div class="input-group input-group-merge">

                            <!-- Input -->
                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Enter confirm password">


                            <!-- Icon -->
                            

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








