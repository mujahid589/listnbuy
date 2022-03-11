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
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>

                @yield('content')



            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection

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
    <script src="{{ asset('frontend') }}/js/plugins/bvselect.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sortBy = new BVSelect({
                selector: '#sortByFilter',
                searchbox: false,
                offset: false,
                placeholder: 'Sort By',
                search_autofocus: true,
                breakpoint: 450,
            });
            var category = new BVSelect({
                selector: '#myadFilterCategory',
                searchbox: false,
                offset: false,
                placeholder: 'All category',
                search_autofocus: true,
                breakpoint: 450,
            });
        });

    </script>
@endsection
