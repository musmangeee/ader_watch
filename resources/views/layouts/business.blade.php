<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

@include('business.partials.head')
<body>


@include('business.partials.modals')

@include('business.partials.sidebar')
@include('business.partials.topnav')
@include('business.partials.sidebar_small')

<div class="main-content">
    @include('business.partials.topbar')
    @yield('content')

</div>
@include('business.partials.scripts')
@yield('script')
</body>

</html>
