@extends('layouts.frontend.layout_one')

@section('title',__('website.ads'))

@section('content')
<x-frontend.breedcrumb-component  :background="$cms->ads_background_path">
    {{ __('website.ad_list') }}
    <x-slot name="items">
        <li class="breedcrumb__page-item">
            <a class="breedcrumb__page-link text--body-3">{{ __('website.ad_list') }}</a>
        </li>
    </x-slot>
</x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <section class="section ad-list">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="ad-list__content row">
                        @forelse ($adlistings as $ad)
                            
                            <x-frontend.search-single-ad :ad="$ad" className="col-lg-4 col-md-6"></x-frontend.single-ad>
                           
                        @empty
                            <x-not-found2 message="No ads found"/>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('adlisting_style')
<link rel="stylesheet"  href="{{ asset('frontend/css') }}/select2.min.css" />
<link rel="stylesheet" href="{{ asset('frontend') }}/css/nouislider.min.css">
<link rel="stylesheet"  href="{{ asset('frontend/css') }}/select2-bootstrap-5-theme.css" />
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/select2/js/select2.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/bvselect.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/nouislider.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/wNumb.min.js"></script>
<script>
    function changeFilter(){
        const slider =document.getElementById('priceRangeSlider')
        const value = slider.noUiSlider.get(true);
        document.getElementById('price_min').value = value[0]
        document.getElementById('price_max').value = value[1]
        const form =  $('#adFilterForm')
        const data = form.serializeArray();
        $('#adFilterForm').submit()
    }

    function setDefaultPriceRangeValue(){
        const slider = document.getElementById('priceRangeSlider')
        slider.noUiSlider.set([{{ request('price_min') }}, {{ request('price_max') }}]);
    }

    $(document).ready(function(){
        const slider = document.getElementById('priceRangeSlider')
        let maxRange = Number.parseInt("{{ $adMaxPrice ?? 500 }}")
        let minPrice = 0;
        let maxPrice = maxRange;
        @if (request()->has('price_min') && request()->has('price_max'))
            minPrice =  Number.parseInt("{{ request('price_min',0) }}")
            maxPrice = Number.parseInt("{{ request('price_max',500) }}")
        @endif
        noUiSlider.create(slider, {
            start: [minPrice, maxPrice],
            connect: true,
            range: {
                min: [0],
                max: [maxRange],
            },
            format: wNumb({
                decimals: 2,
                thousand: ',',
                suffix: ' ($)',
            }),
            tooltips: true,
        });

        slider.noUiSlider.on('change', function(){
            changeFilter();
        });

        // ===== Select2 ===== \\
        $('#town').select2({
            theme: 'bootstrap-5',
            width: $(this).data('width') ?
                $(this).data('width') :
                $(this).hasClass('w-100') ?
                '100%' :
                'style',
            placeholder: 'Select town',
            allowClear: Boolean($(this).data('allow-clear')),
            closeOnSelect: !$(this).attr('multiple'),
        });
    });
</script>
@endsection
