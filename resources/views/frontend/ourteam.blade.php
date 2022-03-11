
@extends('layouts.frontend.layout_one')

@section('title',"Our Team")

@section('content')
<!-- breedcrumb section start  -->
<x-frontend.breedcrumb-component :background="asset('frontend/default_images/ourteam.jpg')">
    {{ __('website.about') }}
    <x-slot name="items">
        <li class="breedcrumb__page-item">
            <a href="{{ route('frontend.about') }}" class="breedcrumb__page-link text--body-3">{{ __('website.about_us') }}</a>
        </li>
    </x-slot>
</x-frontend.breedcrumb-component>
<!-- breedcrumb section end  -->




<!-- ourteam section start  -->
<section >
    <h2 class="text--heading-1 section__title"
        data-aos="fade-up"
        data-aos-offset="0"
        data-aos-delay="30"
        data-aos-duration="700"
        data-aos-easing="ease-in-out"
        data-aos-mirror="true"
        data-aos-once="false"
        data-aos-anchor-placement="top-center"  style="margin-top: 15px">Our Team Members</h2>
    <div class="container" style="margin-bottom: 20px">

        <div class="row">
            @foreach ($ourteams as $team)
                <div class="col-lg-6" style="margin-bottom: 20px">
                    <div class="card" >
                        <div class="card-body">
                            <div class="testimonial-card__user-info">
                                <div class="user-img" style="height: 120px;width: 120px">
                                    @if ($team->image)
                                        <img src="{{ asset($team->image) }}" alt="user-img" />
                                    @else
                                        <img src="{{ asset('backend/image/default.png') }}" alt="user-img" />
                                    @endif
                                </div>
                                <div>
                                    <h2 class="text--body-3 user-name"> {{ $team->name }}</h2>
                                    <span class="designation text--body-4"> {{ $team->position }} </span>
                                </div>
                            </div>

                            <p class="card-text">{!! $team->description !!}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
<!-- ourteam section end  -->

<!--  work section start  -->
<x-others.how-it-work/>
<!--  work section end  -->


@endsection

@section('adlisting_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />
<link rel="stylesheet" href="{{ asset('frontend') }}/js/plugins/css/venobox.min.css" />
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/venobox.min.js"></script>

@endsection

