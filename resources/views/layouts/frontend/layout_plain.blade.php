<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    @hasSection('meta')
        @yield('meta')
    @else
        <meta name="title" content="{{ $settings->seo__meta_title }}">
        <meta name="description" content="{{ $settings->seo_meta_description }}">
        <meta name="keywords" content="{{ $settings->seo_meta_keywords }}">
    @endif


    {{-- <title>@yield('title') - {{ env('APP_NAME') }}</title> --}}
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($settings->favicon_image) }}" />
    <link rel="manifest" href="{{ asset('frontend/images/favicon_io/site.webmanifest') }}" />
    <link rel="stylesheet"  href="{{ asset('frontend/css') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />

    {{-- toastr notification --}}
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- Custom header css & script  --}}
    @yield('adlisting_style')
    @yield('frontend_style')

    <style>
        html {
            height: 100%;
            width: 100%;
        }
        body {
            height: 100%;
            width: 100%;
            margin: 0px;
            padding: 0px;
        }
    </style>

    {!! $settings->header_css !!}
    {!! $settings->header_script !!}
    <link rel="stylesheet"  href="{{ asset('frontend/css') }}/main.css">

</head>

<body >


<!-- loader start  -->
@include('layouts.frontend.partials.loader')
<!-- loader end  -->



@yield('content')





<!-- Scripts goes here -->
<script src="{{ asset('frontend') }}/js/plugins/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/bootstrap.bundle.min.js"></script>

{{-- toastr notificaiton --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"> </script>
<script>
    @if (Session::has('success'))
    toastr.success("{{ Session::get('success') }}", 'Success!')
    @elseif(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}", 'Warning!')
    @elseif(Session::has('error'))
    toastr.error("{{ Session::get('error') }}", 'Error!')
    @endif
    // toast config
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "hideMethod": "fadeOut"
    }
</script>

{{-- Custom footer script  --}}
@yield('frontend_script')
{!! $settings->body_script !!}
<script type="module" src="{{ asset('frontend') }}/js/plugins/app.js"></script>

</body>
</html>
