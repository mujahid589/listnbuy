@extends('layouts.frontend.layout_one')

@section('title',__('website.favorite_ads'))

@section('content')

    {{--    <!-- breedcrumb section start  -->--}}
    {{--    <x-frontend.breedcrumb-component :background="$cms->dashboard_favorite_ads_background_path">--}}
    {{--        {{ __('website.overview')  }}--}}
    {{--        <x-slot name="items">--}}
    {{--            <li class="breedcrumb__page-item">--}}
    {{--                <a href="{{ route('frontend.dashboard') }}" class="breedcrumb__page-link text--body-3">{{ __('website.dashboard') }}</a>--}}
    {{--            </li>--}}
    {{--            <li class="breedcrumb__page-item">--}}
    {{--                <a class="breedcrumb__page-link text--body-3">/</a>--}}
    {{--            </li>--}}
    {{--            <li class="breedcrumb__page-item">--}}
    {{--                <a class="breedcrumb__page-link text--body-3">{{ __('website.favorite_ads') }}</a>--}}
    {{--            </li>--}}
    {{--        </x-slot>--}}
    {{--    </x-frontend.breedcrumb-component>--}}
    {{--    <!-- breedcrumb section end  -->--}}

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>

                @yield('post-ad-content')



            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection
@yield('style')
@section('frontend_style')
    <link rel="manifest" href="{{ asset('frontend') }}/images/favicon_io/site.webmanifest" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/js/plugins/css/slick.css" />
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">

    <style>

        .header-table {
            position: relative;
            min-height: 45px;
            -webkit-transition: all 0.4s ease-in-out;
            transition: all 0.4s ease-in-out;
        }
        .dashboard__myads .header-table {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-top: 32px;
            background-color: #fff;
            -webkit-box-shadow: 0px -1px 0px 0px #ebeef7 inset;
            box-shadow: 0px -1px 0px 0px #ebeef7 inset;
        }
    </style>
@endsection

@section('frontend_script')
    <!-- jQuery -->
    <script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('backend') }}/dist/js/adminlte.js"></script>
    <!-- Alpine js -->
    <script defer src="{{ asset('backend') }}/plugins/alpinejs/alpine.min.js"></script>
    <!-- toastr notification -->
    <script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Navbar Collapse Toggle
        var isNavCollapse = JSON.parse(localStorage.getItem("sidebar_collapse"))
        isNavCollapse ? $('body').addClass('sidebar-collapse') : null;

        $('#nav_collapse').on('click', function() {
            localStorage.setItem("sidebar_collapse", isNavCollapse == true ? false : true);
        });
    </script>
    <!-- Custom Script -->
    @yield('script')

    {!! $settings->body_script !!}

@endsection
