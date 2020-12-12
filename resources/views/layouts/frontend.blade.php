<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

@include('frontend.partials.head')

<body>


@include('frontend.partials.modals')
<div class="main-content">
    @yield('content')

</div>
@include('frontend.partials.scripts')
@yield('script')
</body>

</html>
