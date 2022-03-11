@extends('layouts.frontend.layout_one')

@section('title', __('website.about'))

@section('content')
 <!-- breedcrumb section start  -->
 <x-frontend.breedcrumb-component :background="$cms->about_video_thumb_path">
    {{ __('website.about') }}
    <x-slot name="items">
        <li class="breedcrumb__page-item">
            <a href="{{ route('frontend.about') }}" class="breedcrumb__page-link text--body-3">{{ __('website.about_us') }}</a>
        </li>
    </x-slot>
</x-frontend.breedcrumb-component>
<!-- breedcrumb section end  -->

<!-- about-us section start  -->
<section class="section about-us">
    <div class="container">
        <div class="row">
            <div class="col-xl-6  ">
                <div class="about-us__img-wrapper">
                    <img src="{{  $cms->about_background_path }}" alt="about" class="img-fluid" />
{{--                    <a href="https://youtu.be/vPhg6sc1Mk4" class="icon yplayer" data-autoplay="true" data-vbtype="video">--}}
{{--                        <x-svg.play-icon />--}}
{{--                    </a>--}}
                </div>
            </div>
            <div class="col-xl-6 ">
                <h2 class="about-us__title text--heading-1" >{{ __('website.know_more_about') }}</h2>
                <p class="text--body-3 about-us__brief">
                    {!! $cms->about_body ?? 'No About Us found.' !!}
                </p>
            </div>
            <div class="col-xl-12">
                <p class="text--body-3" style="margin-bottom: 10px">
                    In brainstorming our ideas to forester a true and satisfactory experience, Listnbuy.com has embarked on integrating a 10 to 15 seconds video capture of the seller's cinematographic representation of the listed merchandise. This allows the buyer to experience a first-hand glimpse of a true and realistic view of the product prior to any contract or commitment with the seller.

                </p>
                <p class="text--body-3"  style="margin-bottom: 10px">
                    Our desired goal at Lisnbuy™ USA LLC is to capture excellence and distribute that excellence around the globe so that our consumer-based experiences will populate that class of joyous users whom by their return patronage will help Listnbuy to form an international partnership based on its new worldwide family of users who also acquires wealth by even distribution.

                </p>
                <p class="text--body-3" style="margin-bottom: 10px">
                    Our team at Listnbuy™. is made up of truly minded local and international individuals that have invested their funds, total and absolute commitments, expertise, and dedication in making sure that we produce this web platform that will always be second to none.
                </p>

                <p class="text--body-3" style="margin-bottom: 10px">
                    From our team at Listnbuy USA LLC, situated in the Washington DC capital of the United States of America, we say "Welcome" to a great experience of the E-commerce world of buying and selling. We are truly convinced that you will experience the true joy reality of our mission.  "This is About Us."
                </p>
            </div>
        </div>
    </div>
</section>
<!-- about-us section end  -->

<!--  work section start  -->
<x-others.how-it-work/>
<!--  work section end  -->

@if ($testimonial_enable)
    <!-- testimonial section start  -->
    <section class="testimonial section">
        <div class="container">
            <h2 class="text--heading-1 section__title"
            data-aos="fade-up"
            data-aos-offset="0"
            data-aos-delay="30"
            data-aos-duration="700"
            data-aos-easing="ease-in-out"
            data-aos-mirror="true"
            data-aos-once="false"
            data-aos-anchor-placement="top-center">{{ __('website.what_people_says') }}</h2>

            <div class="testimonial-slider row">
                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-slider__item">
                        <div class="testimonial-card">
                            <ul class="testimonial-card__user-rating">
                                @for($i = 0; $i < $testimonial->stars; $i++)
                                    <li class="testimonial-card__user-rating__icon">
                                        <x-svg.star-icon />
                                    </li>
                                @endfor
                            </ul>
                            <p class="testimonial-card__user-brief text--body-2">
                                {{ $testimonial->description }}
                            </p>
                            <div class="testimonial-card__user-info">
                                <div class="user-img">
                                    @if ($testimonial->image)
                                        <img src="{{ asset($testimonial->image) }}" alt="user-img" />
                                    @else
                                        <img src="{{ asset('backend/image/default.png') }}" alt="user-img" />
                                    @endif
                                </div>
                                <div>
                                    <h2 class="text--body-3 user-name"> {{ $testimonial->name }}</h2>
                                    <span class="designation text--body-4"> {{ $testimonial->position }} </span>
                                </div>
                            </div>
                            <div class="testimonial-card__quotes-icon">
                                <x-svg.quote-icon/>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- testimonial section end  -->
@endif

<!-- suppor-brand section start  -->
<section class="section support-brand pt-0">
    <div class="container">
        <h2 class="section__title text--body-2-600">{{ __('website.supported_by') }}</h2>

        <div class="support-brand__slider">
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend/images/brand/img-01.png') }}" alt="brand-icon" class="img-fluid" />
            </div>
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend') }}/images/brand/img-02.png" alt="brand-icon" class="img-fluid" />
            </div>
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend') }}/images/brand/img-03.png" alt="brand-icon" class="img-fluid" />
            </div>
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend') }}/images/brand/img-04.png" alt="brand-icon" class="img-fluid" />
            </div>
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend') }}/images/brand/img-05.png" alt="brand-icon" class="img-fluid" />
            </div>
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend') }}/images/brand/img-06.png" alt="brand-icon" class="img-fluid" />
            </div>
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend') }}/images/brand/img-01.png" alt="brand-icon" class="img-fluid" />
            </div>
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend') }}/images/brand/img-02.png" alt="brand-icon" class="img-fluid" />
            </div>
            <div class="support-brand__slider-item">
                <img src="{{ asset('frontend') }}/images/brand/img-03.png" alt="brand-icon" class="img-fluid" />
            </div>
        </div>
    </div>
</section>
<!-- suppor-brand section end  -->
@endsection

@section('adlisting_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />
<link rel="stylesheet" href="{{ asset('frontend') }}/js/plugins/css/venobox.min.css" />
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/venobox.min.js"></script>
@endsection

