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
                    Sign in
                </h1>
                <!-- Subheading -->
                <p class="text-muted text-center mb-5">
                    Free access to our dashboard.
                </p>
                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email address -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>Email Address</label>
                        <!-- Input -->
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="name@address.com">
                         @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror

                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <!-- Label -->
                                <label>Password</label>
                            </div>
                            <div class="col-auto">
                                <!-- Help text -->
                                <a href="{{ route('password.request') }}" class="form-text small text-muted">
                                    Forgot password?
                                </a>
                            </div>
                        </div> <!-- / .row -->
                        <!-- Input group -->
                        <div class="input-group input-group-merge">
                            <!-- Input -->
                            <input type="password" class="form-control form-control-appended @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                               @error('password')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                               @enderror

                            <!-- Icon -->
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fe fe-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Submit -->
                    <button class="btn btn-lg btn-block btn-primary mb-3" type="">
                        Sign in
                    </button>
                    <!-- Link -->
                    <div class="text-center">
                        <small class="text-muted text-center">
                            Don't have an account yet? <a href="{{route('signup')}}">Sign up</a>.
                        </small>
                    </div>

                    <a href="{{ route('login.provider', 'google') }}"
                        class="btn btn-white mt-4 w-100 border-light lift"> <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="" class="mr-3">{{ __('Continue with Google') }}</a>

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
