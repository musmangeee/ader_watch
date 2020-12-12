<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

@include('backend.partials.head')
@yield('style')
<body>



<div class="main-content">

    @yield('content')

</div>
@include('backend.partials.scripts')
@yield('script')
</body>

</html>
