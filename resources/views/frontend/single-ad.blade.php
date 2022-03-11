@extends('layouts.frontend.layout_one')

@section('title')
{{ $ad->title }}
@endsection

@php
    $keywords = sprintf("%s, %s",$settings->seo_meta_keywords, join(', ',$ad->adFeatures->pluck('name')->all()));
@endphp

@section('meta')
    <meta name="title" content="{{ $ad->title }}">
    <meta name="description" content="{{ $ad->description }}">
    <meta name="keywords" content="{{ $keywords }}">

    <meta property="og:image" content="{{ $ad->thumbnail }}"/>
    <meta property="og:site_name" content="{{ $settings->name }}">
    <meta property="og:title" content="{{ $ad->title }}">
    <meta property="og:url" content="{{ route('frontend.addetails', $ad->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $ad->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ $settings->name }}" />
    <meta name=twitter:creator content="{{ $ad->customer->name }}" />
    <meta name=twitter:url content="{{ route('frontend.addetails', $ad->slug) }}" />
    <meta name=twitter:title content="{{ $ad->title }}" />
    <meta name=twitter:description content="{{ $ad->description }}" />
    <meta name=twitter:image content="{{ $ad->thumbnail }}" />
@endsection

@section('content')
<!-- breedcrumb section start  -->
{{--<x-frontend.breedcrumb-component :background="$cms->ads_background_path">--}}
{{--    {{ $ad->title }}--}}
{{--    <x-slot name="items">--}}
{{--        <li class="breedcrumb__page-item">--}}
{{--            <a class="breedcrumb__page-link text--body-3">{{ $ad->title }}</a>--}}
{{--        </li>--}}
{{--    </x-slot>--}}
{{--</x-frontend.breedcrumb-component>--}}
<!-- breedcrumb section end  -->






<!-- single ads section start  -->
<section class="product-item section">
    <div class="container">
        <div class="row">

           <div class="col-xl-8">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                   <li class="nav-item" role="presentation">
                       <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All</button>
                   </li>
{{--                   <li class="nav-item" role="presentation">--}}
{{--                       <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Exterior</button>--}}
{{--                   </li>--}}
{{--                   <li class="nav-item" role="presentation">--}}
{{--                       <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Interior</button>--}}
{{--                   </li>--}}
                   <li class="nav-item" role="presentation">
                       <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="contact" aria-selected="false">Video</button>
                   </li>
               </ul>
               <div class="tab-content" id="myTabContent">
                   <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       {{-- ad gallery  --}}
                       <x-ad-details.ad-gallery :galleries="$ad->galleries" :thumbnail="$ad->thumbnail" :slug="$ad->slug" />
                   </div>
{{--                   <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>--}}
{{--                   <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>--}}
                   <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="contact-tab">
                       @if($ad->video==null)
                           <div style="height:200px;width:100%;display: flex;align-items: center;justify-content: center;">
                               <p>No video for this Ad</p>
                           </div>

                       @else
                           <video  style="width: 100%;margin-top: 5px;height:640px;" controls>
                               <source src="{{$ad->video->video}}" >
                               Your browser does not support HTML video.
                           </video>
                       @endif

                   </div>
               </div>


                {{-- ad badge  --}}
                <x-ad-details.ad-badge :featured="$ad->featured" :customerid="$ad->customer_id" />

                {{-- ad info  --}}
                <x-ad-details.ad-info :ad="$ad" />


                {{-- ad description  --}}
                <x-ad-details.ad-description :description="$ad->description" :features="$ad->adFeatures"/>
            </div>
            <div class="col-xl-4">
                <div class="product-item__sidebar">
                    <span class="toggle-bar">
                        <x-svg.toggle-icon />
                    </span>
                    <div class="product-item__sidebar-top">
                        {{-- ad wishlist  --}}
                        <x-ad-details.ad-wishlist :id="$ad->id" :price="$ad->price" />

                        {{-- ad contact  --}}
                        <x-ad-details.ad-contact :phone="$ad->phone" :name="$ad->customer->username" />

                        {{-- ad customer info  --}}
                        <x-ad-details.ad-customer-info :customer="$ad->customer" :town="$ad->town" :city="$ad->city" :link="$ad->website_link"/>
                    </div>
                    <div class="product-item__sidebar-bottom">
                        <div class="product-item__sidebar-item overview">
                            {{-- ad overview  --}}
                            <x-ad-details.ad-overview :ad="$ad" />

                            <p style="display-block;border-bottom: 1px solid #ebeef7"></p>

                            {{-- ad share --}}
                            <x-ad-details.ad-share :slug="$ad->slug" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- single ads section End  -->

<!-- related ads section start  -->
<x-ad-details.ad-related-item :lists="$lists" />
<!-- related ads section end  -->
@endsection
{{--
@section('adlisting_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />
<link rel="stylesheet" href="{{ asset('frontend/css') }}/swiper-bundle.min.css" />
<link rel="stylesheet" href="{{ asset('frontend/css/productslider.css') }}" />
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/swiper-bundle.min.js"></script>
<script>
    function copyToClipboard() {
        let temp = $("<input>");
        $("body").append(temp);
        temp.val(window.location).select();
        document.execCommand("copy");
        temp.remove();

        alert("Copied to clipboard!");
    }

    var swiper = new Swiper(".mySwiper", {
  spaceBetween: 12,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {

    1024: {
      slidesPerView: 6,
    },
    1: {
      slidesPerView: 3,
    },
  },
});

var swiper2 = new Swiper(".mySwiper2", {
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});

</script>
@endsection --}}

@section('adlisting_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />

<link rel="stylesheet" href="{{ asset('frontend/css') }}/swiper-bundle.min.css" />
<link rel="stylesheet" href="{{ asset('frontend/css/productslider.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/jquery.magnify.min.css') }}" />
<style>
    .magnify-modal {
        box-shadow: 0 0 6px 2px rgba(0, 0, 0, .3);
    }

    .magnify-header .magnify-toolbar {
        background-color: rgba(0, 0, 0, .5);
    }

    .magnify-stage {
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        border-width: 0;
    }

    .magnify-footer {
        bottom: 10px;
    }

    .magnify-footer .magnify-toolbar {
        background-color: rgba(0, 0, 0, .5);
        border-radius: 5px;
    }

    .magnify-loader {
        background-color: transparent;
    }

    .magnify-header,
    .magnify-footer {
        pointer-events: none;
    }

    .magnify-button {
        pointer-events: auto;
        color: white;
    }

</style>
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/swiper-bundle.min.js"></script>
<script src="{{ asset('frontend') }}/js/swiperslider.config.js"></script>

<script src="{{ asset('frontend') }}/js/jquery.magnify.min.js"></script>

<script>
    $('[data-magnify]').magnify({
        resizable: false,
        initMaximized: true,
        headerToolbar: [
            'close'
        ],
    });
</script>

@stack('ad_scripts')
@endsection
