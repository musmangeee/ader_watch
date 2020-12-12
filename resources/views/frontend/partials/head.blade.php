<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="AreasGH - Restaurants, Dentists, Bars, Beauty Salons, Doctors" />
    <link rel="icon" href="{{ asset('backend/assets//img/favicon.png') }}" type="image/gif" sizes="16x16">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/fonts/feather/feather.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/fonts/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/libs/flatpickr/dist/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/libs/quill/dist/quill.core.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/libs/highlightjs/styles/vs2015.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/libs/image-upload/image-uploader.min.css') }}" />


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/css/theme.min.css') }}" id="stylesheetLight">
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/css/theme-dark.min.css') }}" id="stylesheetDark">
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/css/custom.css') }}" id="stylesheetDark">
    <link href="//vjs.zencdn.net/7.8.2/video-js.min.css" rel="stylesheet">



    <style>
        body {
            display: none;
        }
    </style>

    <!-- Title -->
    <title>{{ config('app.name', 'AreasGH - Restaurants, Dentists, Bars, Beauty Salons, Doctors') }}</title>

    @yield('style')


</head>