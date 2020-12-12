<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

@include('admin.partials.head')
<body>


@include('admin.partials.modals')

@include('admin.partials.sidebar')
@include('admin.partials.topnav')
@include('admin.partials.sidebar_small')

<div class="main-content">
    @include('admin.partials.topbar')
    @yield('content')

</div>
@include('admin.partials.scripts')
@yield('script')
</body>

</html>
