@extends('layouts.frontend.layout_one')

@section('title')
'{{ $category->name }}' {{ __('website.wise_ads') }}
@endsection

@section('content')
{{--    <!-- banner section start  -->--}}
{{--    <div class="banner banner--two" style="background: url('{{ $headerimage }}') center center/cover no-repeat;">--}}
{{--        <div class="container">--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- banner section end   -->--}}

    <!-- banner section start  -->
    <div class="banner banner--two" style="background: url('{{ $headerimage }}') center center/cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 align-content-lg-center justify-content-lg-center">
                    <h2 class="text--display-3 banner__title animate__animated animate__bounceInDown">{{ __('website.banner_header') }}
                        {{$category->name}}</h2>
                    {{--                    <p class="text--body-3 banner__brief">--}}
                    {{--                        {{ __('website.banner_description') }}--}}
                    {{--                    </p>--}}
                    <div className="container">
                        <div class="row">
                            <div class="topcategory">

                                @foreach ($topCategories as $cat)
                                    <div class="catitems">
                                        <a href="{{ route('frontend.adlist.category.show', $cat->slug) }}" class="second view-btn">

                                            <div class="caticonbox">
                                                <div class="topcaticon">
                                                    <i class="{{ $cat->icon }}" style="font-size: 24px;color: #fff"></i>
                                                </div>

                                                <p class="" style="color: #fff;font-size:12px">{{ $cat->name }}</p>

                                            </div>

                                            {{--                                            <div>--}}
                                            {{--                                                <a href="{{ route('frontend.adlist.category.show', $category->slug) }}" class="second view-btn">--}}
                                            {{--                                                {{ __('website.view_ads') }}--}}
                                            {{--                                                    <span class="icon">--}}
                                            {{--                                                        <x-svg.right-arrow-icon stroke="#00AAFF" />--}}
                                            {{--                                                    </span>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </div>--}}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner section end   -->



    <!-- recent-post section start  -->
    <section class="section recent-post">
        <div class="container-fluid">
{{--            <h2 class="text--heading-1 section__title">--}}
{{--                {{ $category->name }}--}}
{{--            </h2>--}}
            <div class=" row">
{{--                <div class="ad-list__content row">    --}}
                @forelse ($adlistings as $ad)
                    <x-frontend.single-ad :ad="$ad" :category="$category" className="col-md-2"></x-frontend.single-ad>

                @empty
                    <x-not-found2 message="Sorry ! No ads found"/>
                @endforelse
            </div>
            <div class="page-navigation">
                {{ $adlistings->links() }}
            </div>
        </div>
    </section>
@endsection
