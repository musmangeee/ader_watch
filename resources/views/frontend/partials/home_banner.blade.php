<header class="w-100 pt-3 areasgh-hero"
        style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.73), rgba(0, 0, 0, 0.2)), url('{{ asset('frontend/img/banner/'.$data['pref_wallpaper']) }}');background-repeat: no-repeat;
                background-position: center;
                background-size: cover;">
    <div class="container h-100">
        <nav class="navbar navbar-expand-xl navbar-dark mb-2 bg-transparent border-0">
            <div class="container-fluid">

                <!-- Brand -->
                <!-- Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('frontend/img/logos/logo-2.png') }}" alt="">
                </a>
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Nav -->
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">Home</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('library.index')}}" class="nav-link">Library</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('shuffle.index')}}" class="nav-link">Shuffle</a>
                        </li>

                        <li class="nav-item mr-lg-5 mr-4">
                            <a href="{{ url('my/business/create') }}" class="nav-link">Ad upload</a>
                        </li>
                        @guest


                            <li class="nav-item">
                                <a href="{{route('login')}}" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item ml-lg-4">
                                <a href="{{route('signup')}}" class="btn btn-primary text-white px-4">Sign Up</a>

                            </li>

                        @else
                            <li class="nav-item dropdown">

                                <a class="nav-link dropdown-toggle  text-white" href="#" id="navbarDropdownMenuLink5"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <div class="avatar avatar-sm  mr-2">
                                        @if(auth()->user()->avatar)
                                            <img src=" {{ auth()->user()->avatar }}" alt="avatar-img rounded-circle" width="32" height="32"
                                                 style="margin-right: 8px;; border-radius: 50%">
                                        @else
                                            <span class="avatar-title rounded-circle">@php echo explode(" ", Auth::user()->name)[0][0] . explode(" ", Auth::user()->name)[1][0];  @endphp</span>
                                        @endif
                                    </div>


                                    {{ explode(' ', auth()->user()->name, 2)[0] }} <span class="caret"></span>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg-right">
                                    <li><a class="dropdown-item" href="{{ url('home') }}"><i class="fa fa-user pr-2"></i>About Me</a></li>
                                    
                                    <li><a class="dropdown-item" href="{{ url('setting') }}"><i class="fa fa-sign pr-2"></i>Account Settings</a></li>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pr-2"></i>Logout</a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>

                                </ul>

                            </li>
                        @endguest
                    </ul>

                </div>

            </div>
        </nav>


        <div class="container h-100 mt-7">
            <div class="row h-100 justify-content-center align-items-center">
                <form action="{{route('search')}}" method="GET" class="col-12">
                    <h1 class="text-center text-white mt-5" style="font-size: 3rem">Earn Money by Watching Ads!</h1>
                    <div class="input-group mb-3 mt-5">
                        <input type="text" class="autocomplete_find form-control" name="find" autocomplete="off" placeholder="Search">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary rounded-right" type="submit"><i
                                        class="fe fe-search mx-3"></i></button>
                        </div>
                    </div>

                    <ul class="nav justify-content-center mt-5 mb-5">
                        @for($a = 0; $a<4; $a++)
                            <li class="nav-item">
                                <a class="nav-link active text-white"
                                   href="{{ url('search?find='.urlencode($data['pref_categories'][$a])) }}">
                                    {{ $data['pref_categories'][$a] }}</a>
                            </li>
                        @endfor
                    </ul>
                </form>
            </div>

        </div>
    </div>
</header>