<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

@include('backend.partials.head')
@yield('style')
<body>


@include('backend.partials.modals')

@include('backend.partials.sidebar')
@include('backend.partials.topnav')
@include('backend.partials.sidebar_small')

<div class="main-content">
    @include('backend.partials.topbar')
    @yield('content')

</div>
@include('backend.partials.scripts')
@yield('script')
</body>

</html>
