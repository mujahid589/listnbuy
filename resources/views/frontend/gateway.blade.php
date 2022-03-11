
@extends('layouts.frontend.layout_one')

@section('title', __('website.home'))

@section('frontend_style')
    @livewireStyles
@endsection


@section('content')

    <!-- top-category section start  -->
{{--        <section class="section top-category bgcolor--gray-10">--}}
{{--            <div class="container">--}}
{{--                <h2 class="text--heading-1 section__title">--}}
{{--                    {{ __('website.top_category') }}--}}
{{--                </h2>--}}
{{--                <div class="row">--}}
{{--                    @forelse ($topCategories as $category)--}}
{{--                        <div class="col-lg-4 col-md-6 mb-4">--}}
{{--                            <div class="categorylist-card">--}}
{{--                                <div class="categorylist-card__top">--}}
{{--                                    <div class="categorylist-card__top-left">--}}
{{--                                        <h2 class="categorylist-card__title text--body-2-600"> {{ $category->name }} </h2>--}}
{{--                                        <span class="categorylist-card__item-available">({{ $category->ad_count ?? 0 }})</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="categorylist-card__top-right">--}}
{{--                                        <div class="categorylist-card__icon">--}}
{{--                                            <i class="{{ $category->icon }}" style="font-size: 55px"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @empty--}}
{{--                    <x-no-data-found/>--}}
{{--                    @endforelse--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
    <!-- top-category section end  -->




    <!-- top-category section start  -->
    <section class="section top-category bgcolor--gray-10">
        <div class="container">
            {{--                <h2 class="text--heading-1 section__title">--}}
            {{--                    {{ __('website.top_category') }}--}}
            {{--                </h2>--}}
            <div class="row">
                @forelse ($topCategories as $category)

                        <div class="col-lg-3 col-md-6 mb-4">
                            <div href="{{ route('frontend.adlist.category.show', $category->slug) }}" style="height: 200px;width: 100%;text-align: center;padding-top: 100px;color: white;over-flow: hidden;background:url({{$category->image}}) ;background-size: cover;backgroundRepeat: no-repeat;display: flex;flex-direction: row">
                                <a class="gatewaysmallDiv" href="{{ route('frontend.adlist.category.show', $category->slug) }}" >
{{--                                    <div  >--}}
                                       <p class="gatewaypStyle">
                                           {{ $category->name }}
                                       </p>
{{--                                   </div>--}}
                                </a>
                           </div>
                        </div>

                @empty
                    <x-no-data-found/>
                @endforelse
            </div>
        </div>
    </section>
    <!-- top-category section end  -->






@endsection

@section('frontend_script')
    <script type="module" src="{{ asset('frontend') }}/js/plugins/purecounter.js"></script>
    @stack('newslater_script')

@endsection
