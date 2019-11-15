<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="Development" content="Alireza Bazargani." />
    <meta name="description" content="Tiny-CMS" />
    <meta name="author" content="" />
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('assets/css/uikit-rtl.min.css') }}" />
    <script src="{{ asset('assets/js/uikit.min.js') }}"></script>
    <script src="{{ asset('assets/js/uikit-icons.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/b3zbxrwztsjum71vs51caf64xuyitiqpxu3irnfb1i7qgusn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'#content',
            plugins : 'visualblocks wordcount ltr rtl directionality advlist autolink link image lists charmap print preview table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol code',
            toolbar: 'visualblocks wordcount ltr rtl directionality advlist autolink link image lists charmap print preview table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol code',
            directionality : "rtl",
            height: 500
        });
    </script>
    <style>
        *:not(i) {
            font-family: IRANSans !important;
        }
    </style>
</head>
<body>
<div>
    @include('public.template-parts.header')
    @include('admin.template-parts.sidebar')
    @yield('content')
    @include('admin.template-parts.footer')
</div>
    @include('admin.template-parts.scripts')
</body>
</html>
