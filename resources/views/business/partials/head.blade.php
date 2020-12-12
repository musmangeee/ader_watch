<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/fonts/feather/feather.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/libs/flatpickr/dist/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/libs/quill/dist/quill.core.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/libs/highlightjs/styles/vs2015.css') }}" />


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/css/theme.min.css') }}" id="stylesheetLight">
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/css/theme-dark.min.css') }}" id="stylesheetDark">
    @yield('style')

    <style>
        body {
            display: none;
        }
    </style>

    <!-- Title -->
    <title>AreasGH</title>


</head>
