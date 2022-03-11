{{--<div class="{{ $className }}">--}}
<div  class="single-ad">
    <div class="cards cards--one {{  $ad->featured ? 'cards--highlight':'' }}" style="border-radius: 0">
        <div class="ribbon ribbon-top-left" >
           <p>{{$ad->condition}}</p>
        </div>

        {{-- <div class="ribbon ribbon-top-right" >
            <p>{{$ad->condition}}</p>
         </div> --}}
        <a href="{{ route('frontend.addetails',$ad->slug) }}" class="cards__img-wrapper" style="border-radius: 0;height: 200px">
            @if ($ad->thumbnail)
                <img src="{{ asset($ad->thumbnail) }}" height="200" alt="card-img" class="img-fluid" style="object-fit: cover;height:200px" />
            @else
                <img src="{{ asset('backend/image/default-ad.png') }}" height="200" alt="card-img" class="img-fluid" style="object-fit: cover;height:200px"  />
            @endif
        </a>
        <div class="cards__info" style="border-radius: 0">
            <div class="cards__info-top">
                <h6 class="text--body-4 cards__category-title">
                    <span class="icon">
                        <i class="{{ $ad->category->icon }}" style="font-size: 15px"></i>
                    </span>
                    {{ $ad->category->name }}
                </h6>
                <a href="{{ route('frontend.addetails',$ad->slug) }}" class="" style="font-size:15px;color: #191f33;font-weight:200">
                    {{ \Illuminate\Support\Str::limit($ad->title, 30, $end='...') }}
                </a>
            </div>
            <div class="cards__info-bottom" style="border-radius: 0">
                <h6 class="cards__location text--body-4">
                    <span class="icon">
                        <x-svg.location-icon width="20" height="20" stroke="#27C200" />
                    </span>
                    {{ $ad->city->name }}
                </h6>
                <span class="cards__price-title text--body-3-600" style="color:#2A84F2;">$ {{ $ad->price }} </span>
            </div>
        </div>
    </div>
</div>
