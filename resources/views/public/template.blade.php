<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="Development" content="Alireza Bazargani." />
    <meta name="description" content="Tiny-CMS" />
    <meta name="author" content="Alireza Bazargani" />
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('assets/css/uikit-rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <script src="{{ asset('assets/js/uikit.min.js') }}"></script>
    <script src="{{ asset('assets/js/uikit-icons.min.js') }}"></script>
    <style media="screen">
    @media screen and (max-width: 479px) {
    /* start of phone styles */
      h1 {
        font-size: 24px!important;
      }
      h2 {
        font-size: 20px!important;
      }
      h3 {
        font-size: 16px!important;
      }
      h4 {
        font-size: 16px!important;
      }
    }
    </style>
</head>
<body>
    @include('public.template-parts.header')
    @yield('content')
    @include('public.template-parts.footer')
    @include('public.template-parts.scripts')
</body>
</html>
