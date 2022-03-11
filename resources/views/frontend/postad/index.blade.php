@extends('layouts.frontend.layout_one')

@section('title', __('website.ad_post'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_post_ads_background_path">
        {{ __('website.overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}" class="breedcrumb__page-link text--body-3">{{ __('website.dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('website.post_ads') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9" >
                    <div class="dashboard-post" style="box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.04), 0px 2px 6px rgba(0, 0, 0, 0.04), 0px 0px 1px rgba(0, 0, 0, 0.04);border-radius:1px;">
                        <ul class="nav dashboard-post__nav mb-3">
                            {{-- Step 1  --}}
                            @if (request()->route()->getName() === "frontend.post")
                                <a href="{{ route('frontend.post') }}">
                                    <x-ad.ad-step/>
                                </a>
                            @else
                                <button disabled>
                                    <x-ad.ad-step/>
                                </button>
                            @endif

                            {{-- Step 2 --}}
                            @if (request()->route()->getName() === "frontend.post.step2")
                                <a href="{{ route('frontend.post.step2') }}">
                                    <x-ad.ad-step2/>
                                </a>
                            @else
                                <button disabled>
                                    <x-ad.ad-step2/>
                                </button>
                            @endif

                            {{-- Step 3 --}}
                            @if (request()->route()->getName() === "frontend.post.step3")
                                <a href="{{ route('frontend.post.step3') }}">
                                    <x-ad.ad-step3/>
                                </a>
                            @else
                                <button disabled>
                                    <x-ad.ad-step3/>
                                </button>
                            @endif
                        </ul>
                        <div class="tab-content dashboard-post__content" id="pills-tabContent">
                            @yield('post-ad-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @isset($ad->category_id)
            <input type="hidden" id="cat_id" value="{{ $ad->category_id }}">
        @else
            <input type="hidden" id="cat_id" value="">
        @endisset

        @isset($ad->city_id)
            <input type="hidden" id="ct_id" value="{{ $ad->city_id }}">
        @else
            <input type="hidden" id="ct_id" value="">
        @endisset

        @isset($ad->subcategory_id)
            <input type="hidden" id="subct_id" value="{{ $ad->subcategory_id }}">
        @else
            <input type="hidden" id="subct_id" value="">
        @endisset

        @isset($ad->town_id)
            <input type="hidden" id="town_id" value="{{ $ad->town_id }}">
        @else
            <input type="hidden" id="town_id" value="">
        @endisset

        @isset($ad->brand_id)
            <input type="hidden" id="brand_id" value="{{ $ad->brand_id }}">
        @else
            <input type="hidden" id="brand_id" value="">
        @endisset
    </section>
    <!-- dashboard section end  -->
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>

    <script>
        $(document).ready(function(){

            // change screens by categories
            $("#ad_category").change(function(){

                var selectedCategory = $(this).children("option:selected").text();
                 selectedCategory=selectedCategory.toLowerCase();
                if (selectedCategory === "vehicles" || selectedCategory.includes("car") ) {
                    $('#classificationSelectTitle').text('Vehicle Body Type');
                    $('#makeSelectTitle').text('Vehicle Make');
                    $('#modelInputTitle').text('Vehicle Model');

                    $('.hide-on-handyman').show();
                    $('.only-cars').show();
                    $('.hide-on-rent').hide();
                    $('.only-cars select, .only-cars input').removeClass('ignore')
                    $('.cars-and-bikes').show();
                    $('.cars-and-bikes select, .cars-and-bikes input').removeClass('ignore')
                    $('.only-parts').hide();
                    $('.only-parts select, .only-parts input').addClass('ignore')
                    $('.only-bikes').hide();
                    $('.only-bikes select, .only-bikes input').addClass('ignore')
                    $('.only-general').hide();
                    $('.only-general select, .only-general input').addClass('ignore');
                    $('.hide-on-general').show();
                    $('.hide-on-general select, .hide-on-general input').removeClass('ignore')
                }


                if (selectedCategory.includes("bike")) {
                    $('#classificationSelectTitle').text('Bike Body Type');
                    $('#makeSelectTitle').text('Bike Make');
                    $('#modelInputTitle').text('Select / Enter Model');

                    $('.hide-on-handyman').show();
                    $('.only-bikes').show();
                    $('.hide-on-rent').hide();
                    $('.only-bikes select, .only-bikes input').removeClass('ignore')
                    $('.cars-and-bikes').show();
                    $('.cars-and-bikes select, .cars-and-bikes input').removeClass('ignore')
                    $('.only-cars').hide();
                    $('.only-cars select, .only-cars input').addClass('ignore')
                    $('.only-parts').hide();
                    $('.only-parts select, .only-parts input').addClass('ignore')
                    $('.only-general').hide();
                    $('.only-general select, .only-general input').addClass('ignore');
                    $('.hide-on-general').show();
                    $('.hide-on-general select, .hide-on-general input').removeClass('ignore')
                }
                if (selectedCategory.includes("parts")) {
                    $('#classificationSelectTitle').text('Make');
                    $('#makeSelectTitle').text('Model');
                    $('#modelInputTitle').text('Select / Enter Part');

                    $('.hide-on-handyman').show();
                    $('.only-parts').show();
                    $('.hide-on-rent').hide();
                    $('.only-parts select, .only-parts input').removeClass('ignore');
                    $('.only-cars').hide();
                    $('.only-cars select, .only-cars input').addClass('ignore')
                    $('.cars-and-bikes').hide();
                    $('.cars-and-bikes select, .cars-and-bikes input').addClass('ignore')
                    $('.only-bikes').hide();
                    $('.only-bikes select, .only-bikes input').addClass('ignore')
                    $('.only-general').hide();
                    $('.only-general select, .only-general input').addClass('ignore');
                    $('.hide-on-general').show();
                    $('.hide-on-general select, .hide-on-general input').removeClass('ignore')
                }
                if (selectedCategory.includes("gen")) {
                    $('#classificationSelectTitle').text('Category');
                    $('#makeSelectTitle').text('Sub Category');
                    $('#modelInputTitle').text('Select / Enter Item name');

                    $('.hide-on-handyman').show();
                    $('.only-general').show();
                    $('.hide-on-rent').show();
                    $('.only-general select, .only-general input').removeClass('ignore');
                    $('.hide-on-general').hide();
                    $('.hide-on-general select, .hide-on-general input').addClass('ignore')
                    $('.cars-and-bikes').hide();
                    $('.cars-and-bikes select, .cars-and-bikes input').addClass('ignore')
                    $('.only-cars').hide();
                    $('.only-cars select, .only-cars input').addClass('ignore')
                    $('.only-bikes').hide();
                    $('.only-bikes select, .only-bikes input').addClass('ignore')
                    $('.only-parts').hide();
                    $('.only-parts select, .only-parts input').addClass('ignore')
                }

                if (selectedCategory.includes("handy")) {
                    $('#catag').hide();
                    // $('#classificationSelectTitle').text('Category');
                    $('#makeSelectTitle').text('Sub Category');
                    $('#modelInputTitle').text('Select / Enter Item name');

                    $('.hide-on-rent').show();
                    $('.only-general').show();
                    $('.only-general select, .only-general input').removeClass('ignore');
                    $('.hide-on-general').hide();
                    $('.hide-on-handyman').hide();
                    $('.hide-on-general select, .hide-on-general input').addClass('ignore')
                    $('.cars-and-bikes').hide();
                    $('.cars-and-bikes select, .cars-and-bikes input').addClass('ignore')
                    $('.only-cars').hide();
                    $('.only-cars select, .only-cars input').addClass('ignore')
                    $('.only-bikes').hide();
                    $('.only-bikes select, .only-bikes input').addClass('ignore')
                    $('.only-parts').hide();
                    $('.only-parts select, .only-parts input').addClass('ignore')
                }

                if (selectedCategory.includes("rent")) {
                    $('#classificationSelectTitle').text('Category');
                    $('#makeSelectTitle').text('Sub Category');
                    $('#modelInputTitle').text('Select / Enter Item name');

                    $('.hide-on-rent').show();
                    $('.only-general').show();
                    $('.only-general select, .only-general input').removeClass('ignore');
                    $('.hide-on-general').hide();
                    $('.hide-on-handyman').hide();
                    $('.hide-on-general select, .hide-on-general input').addClass('ignore')
                    $('.cars-and-bikes').hide();
                    $('.cars-and-bikes select, .cars-and-bikes input').addClass('ignore')
                    $('.only-cars').hide();
                    $('.only-cars select, .only-cars input').addClass('ignore')
                    $('.only-bikes').hide();
                    $('.only-bikes select, .only-bikes input').addClass('ignore')
                    $('.only-parts').hide();
                    $('.only-parts select, .only-parts input').addClass('ignore')
                }


            });
        });
    </script>


    <script>
        // session category wise subcategory
        var cat_id = document.getElementById('cat_id').value;
        var ct_id = document.getElementById('ct_id').value;
        var subct_id = document.getElementById('subct_id').value;
        var town_id = document.getElementById('town_id').value;

        var brand_id = document.getElementById('brand_id').value;

        var model_id = document.getElementById('model_id').value;

        if (cat_id){ cat_wise_subcat(cat_id) }
        if (ct_id){ city_wise_town(ct_id) }

        // Category wise subcategories
        $('#ad_category').on('change', function() {
        var categoryID = $(this).val();
            if(categoryID) {
                cat_wise_subcat(categoryID);
            }
        });

        // City wise town
        $('#cityy').on('change', function() {
        var cityID = $(this).val();
            if(cityID) {
                city_wise_town(cityID);
            }else{
                $('#townn').empty();
            }
        });

        // cat wise brand
        $('#ad_category').on('change', function() {
            var catID = $(this).val();
            if(catID) {
                category_wise_brands(catID);
            }else{
                $('#brand_id').empty();
            }
        });


        // brand wise model
        $('#brand_id').on('change', function() {
            var brandID = $(this).val();
            if(brandID) {
                brands_wise_models(brandID);
            }else{
                $('#model_id').empty();
            }
        });

        // City wise town
        $('#cityy').on('change', function() {
            var cityID = $(this).val();
            if(cityID) {
                city_wise_town(cityID);
            }else{
                $('#townn').empty();
            }
        });

        // cat wise subcat function
        function cat_wise_subcat(categoryID){
            axios.get('/get-sub-categories/'+categoryID).then((res => {
                if(res.data){
                    $('#brand_id').empty();
                    $.each(res.data, function(key, subcat){
                        var matched = parseInt(subct_id) === subcat.id ? true: false

                        $('select[name="brand_id"]').append(
                            `<option ${matched ? 'selected':''} value="${subcat.id}">${subcat.name}</option>`
                        );
                    });
                }else{
                    $('#brand_id').empty();
                }
            }))
        }

        // city wise town function
        function city_wise_town(cityID){
            axios.get('/get-towns/'+cityID).then((res => {
                if(res.data){
                    $('#townn').empty();
                    $.each(res.data, function(key, town){
                        var matched = parseInt(town_id) === town.id ? true: false

                        $('select[name="town_id"]').append(
                            `<option ${matched ? 'selected':''} value="${town.id}">${town.name}</option>`
                        );
                    });
                }else{
                    $('#townn').empty();
                }
            }))
        }

        // cat wise brands function
        function category_wise_brands(cat_id){
            axios.get('/dashboard/get_brands/'+cat_id).then((res => {
                if(res.data){
                    console.log(res.data);
                    $('#brand_id').empty();
                    $.each(res.data, function(key, brand){
                        var matched = parseInt(brand_id) === brand.id ? true: false

                        $('select[name="brand_id"]').append(
                            `<option ${matched ? 'selected':''} value="${brand.id}">${brand.name}</option>`
                        );
                    });
                }else{
                    $('#brand_id').empty();
                }
            }))
        }

        // city wise town function
        function brands_wise_models(brand_id){
            axios.get('/dashboard/get_models/'+brand_id).then((res => {
                if(res.data){
                    console.log(res.data);
                    $('#model_id').empty();
                    $.each(res.data, function(key, model){
                        var matched = town_id === model.name ? true: false

                        $('select[name="model"]').append(
                            `<option ${matched ? 'selected':''} value="${model.name} ">${model.name} </option>`
                        );
                    });
                }else{
                    $('#model_id').empty();
                }
            }))
        }
    </script>

    @stack('post-ad-scripts')
@endsection

@section('frontend_style')
    <link rel="stylesheet" href="{{ asset('css/zakirsoft.css') }}">
@endsection
