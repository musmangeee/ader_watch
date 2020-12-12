<!DOCTYPE html>
<html lang="zxx">
@include('frontend.partials.head')

<body>
    <div class="page_loader"></div>

    <!-- Contact section start -->
    <div class="contact-section">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-6 align-self-center pad-0">
                    <div class="form-section align-self-center">
                        <h3>Sign into your account</h3>
                        <div class="btn-section clearfix">
                            <a href="{{route('login')}}" class="link-btn active btn-1 active-bg">Login</a>
                            <a href="{{route('register')}}" class="link-btn btn-2 default-bg">Register</a>

                        </div>
                        <div class="clearfix"></div>
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group form-box">
                                <input type="email" name="email" class="input-text @error('email') is-invalid @enderror" placeholder="Email Address">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group form-box clearfix">
                                <input type="password" name="password" class="input-text @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group clearfix mb-0">
                                <button type="submit" class="btn-md btn-theme float-left">Login</button>
                                <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password</a>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 bg-color-15 align-self-center pad-0 none-992 bg-img">
                    <div class="info clearfix">
                        <div class="logo-2">
                            <a href="index.html">
                                <img src="img/logos/logo-2.png" class="cm-logo" alt="black-logo">
                            </a>
                        </div>
                        <h3>Welcome to AreasGH</h3>
                        <div class="social-list">
                            <a href="#" class="facebook-bg">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="twitter-bg">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" class="google-bg">
                                <i class="fa fa-google"></i>
                            </a>
                            <a href="#" class="linkedin-bg">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    @include('frontend.partials.scripts')

</body>

<!-- Mirrored from storage.googleapis.com/themevessel-products/housy/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 May 2020 10:06:02 GMT -->
</html>










{{--  @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  --}}
