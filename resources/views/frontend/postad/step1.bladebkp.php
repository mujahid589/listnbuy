@extends('frontend.postad.index')

@section('title', __('website.step1'))

@section('post-ad-content')
    <style>
        input{
            background-color: #F3F4F8;
        }
        select{
            background-color: #F3F4F8 !important;
            font-size: 14px;
        }
        option{
            background-color: #FFF;
            font-size: 14px;
        }

        .input-select{
            /*width: 200px;*/
            /*height: 40px;*/
            height: 100%;
            overflow: hidden;
            /*border: 1px solid black;*/
            border-radius: 3px;
            position: relative; // Added
        }
        .input-select select{
            -webkit-appearance: none;
            -moz-appearance:none;
            -ms-appearance:none;
            appearance:none;
            /*width: 100%;*/
            height: 40px;
            border: none;
        }

        .input-select:after {
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 5px 5px 0 5px;
            border-color: #007bff transparent transparent transparent;
            position: absolute;
            right: 10px;
            content: "";
            top: 50px;
            pointer-event: none;
        }

    </style>

    <!-- Step 01 -->
    <div class="tab-pane fade show active" id="pills-basic" role="tabpanel" aria-labelledby="pills-basic-tab">
        <div class="dashboard-post__information step-information">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form novalidate action="{{ route('frontend.post.store') }}" method="POST">
                @csrf

                        <div class="dashboard-post__information-form">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="input-select ">
                                         <label for="allCategory">What are you listing ?<span class="text-danger">*</span></label>
                                         <select required name="category_id" id="ad_category" class="form-control select-bg @error('category_id') border-danger @enderror">
                                             <option value="" hidden>Select Category</option>
                                             @isset($ad->category_id)
                                                 @foreach ($categories as $category)
                                                     <option {{ $category->id == $ad->category_id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                 @endforeach
                                             @else
                                                 @foreach ($categories as $category)
                                                     <option {{ old('category_id') == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                 @endforeach
                                             @endisset
                                         </select>
                                     </div>
                                    </div>

                                    <div class="col-sm-4 hide-on-rent">
                                        <div class="input-field">
                                            <label for="adname"> Ad Name <span class="text-danger">*</span></label>
                                            <input  value="{{ $ad->title ?? '' }}" name="title" type="text" placeholder="Ad Title" id="adname"  class="@error('title') border-danger @enderror"/>
                                        </div>
                                    </div>



                                    <div class="col-sm-4  hide-on-general">
                                        <div class="input-select  ">
                                            <label for="brand">Year <span class="text-danger">*</span></label>
                                            <select required name="model_year" id="model_year" class="form-control select-bg @error('model_year') border-danger @enderror">
                                                <option value="" hidden>Select Year</option>

                                                @for ($i = 1901; $i < 2050; $i++)
                                                    <option {{ old('model_year') == $i || date('Y') == $i ? "selected" : "" }} value="{{ $i }}">{{ $i }}</option>
                                                @endfor

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-select">

                                            <label for="brand" id="classificationSelectTitle">Body Type <span class="text-danger">*</span></label>
                                            <select required name="body_type" id="body_type" class="form-control select-bg @error('body_type') border-danger @enderror">
                                                <option value="" hidden>Select Body Type</option>
                                                @isset($ad->vehicleFeatures->vehicle_body_type )
                                                    @foreach ($body_types as $body_type)
                                                        <option {{ $body_type->name == $ad->vehicleFeatures->vehicle_body_type  ? 'selected':'' }} value="{{ $body_type->name }}">{{ $body_type->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($body_types as $body_type)
                                                        <option {{ old('body_type') == $body_type->name  ? 'selected':'' }} value="{{$body_type->name   }}">{{ $body_type->name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="input-select">
                                            <label for="brand" id="makeSelectTitle">Make <span class="text-danger">*</span></label>
                                            <select required name="brand_id" id="brand_id" class="form-control select-bg @error('brand_id') border-danger @enderror">
                                                <option value="" hidden>Select Brand</option>
                                                @isset($ad->brand_id)
                                                    @foreach ($brands as $brand)
                                                        <option {{ $brand->id == $ad->brand_id ? 'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($brands as $brand)
                                                        <option {{ old('brand_id') == $brand->id ? 'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 hide-on-handyman">
                                        <div class="input-select ">
                                            <label for="brand" id="modelInputTitle">Model <span class="text-danger">*</span></label>
                                            <select required name="model" id="model_id" class="form-control select-bg @error('model') border-danger @enderror">
                                                <option value="" hidden>Select Model</option>
                                                @isset($ad->model)
                                                    @foreach ($models as $model)
                                                        <option {{ $model->name == $ad->model ? 'selected':'' }} value="{{ $model->name }}">{{ $model->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($models as $model)
                                                        <option {{ old('model') == $model->name ? 'selected':'' }} value="{{ $model->name }}">{{ $model->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-sm-4">
                                        <div class="input-field">
                                           <label for="price"> Price <span class="text-danger">*</span></label>
                                           <input required value="{{ $ad->price ?? '' }}" name="price" type="number" min="1" placeholder="Price" id="price"  class="@error('price') border-danger @enderror"/>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-field ">
                                            <label for="suggested_retail_price"> Suggested Retail Price <span class="text-danger">*</span></label>
                                            <input  value="{{ $ad->suggested_retail_price ?? '' }}" name="suggested_retail_price" type="number" min="1" placeholder="suggested retail price" id="suggested_retail_price"  class="@error('suggested_retail_price') border-danger @enderror"/>
                                        </div>

                                    </div>




                                    <div class="col-sm-4">

                                        <div class="input-select ">
                                            <label for="brand">Condition <span class="text-danger">*</span></label>
                                            <select required name="condition" id="condition" class="form-control select-bg @error('condition') border-danger @enderror">
                                                <option value="" hidden>Select Conditions</option>
                                                @isset($ad->condition)
                                                    @foreach ($conditions as $condition)
                                                        <option {{ $condition->name == $ad->condition ? 'selected':'' }} value="{{ $condition->name}}">{{ $condition->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($conditions as $condition)
                                                        <option {{ old('condition') == $condition->name  ? 'selected':'' }} value="{{$condition->name }}">{{ $condition->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-sm-4">
                                        <div class="input-field col-lg-4">
                                            <label for="phoneNumber">Phone Number <span class="text-danger">*</span></label>
                                            <input required name="phone" id="phoneNumber" type="tel" placeholder="Phone" value="{{ $ad->phone ?? '' }}" class="@error('phone') border-danger @enderror"/>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-select col-lg-4">
                                            <label for="cityy">city</label>
                                            <select required name="city_id" id="cityy" class="form-control select-bg @error('city_id') border-danger @enderror">
                                                <option class="d-none" value="" selected>Select City</option>
                                                @isset($ad->brand_id)
                                                    @foreach ($citis as $city)
                                                        <option {{ $city->id == $ad->city_id ? 'selected':'' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($citis as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-select col-lg-4">
                                            <label for="townn">Town</label>
                                            <select required name="town_id" id="townn" class="form-control select-bg @error('town_id') border-danger @enderror">
                                                <option value="" hidden>Select Town</option>
                                            </select>
                                        </div>

                                    </div>


                                    <div class="col-sm-4  cars-and-bikes">
                                        <div class="input-select  ">
                                    <label for="brand">Transmissions <span class="text-danger">*</span></label>
                                    <select required name="transmission" id="transmission" class="form-control select-bg @error('brand_id') border-danger @enderror">
                                        <option value="" hidden>Select Transmission</option>
                                        @isset($ad->vehicleFeatures->transmission_type)
                                            @foreach ($transmissions as $transmission)
                                                <option {{ $transmission->name == $ad->vehicleFeatures->transmission_type ? 'selected':'' }} value="{{ $transmission->name }}">{{ $transmission->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($transmissions as $transmission)
                                                <option {{ old('transmission') == $transmission->name ? 'selected':'' }} value="{{ $transmission->name }}">{{ $transmission->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                    </div>


                                    <div class="col-sm-4  cars-and-bikes">

                                            <div class="input-select ">
                                                <label for="brand">Fuel <span class="text-danger">*</span></label>
                                                <select required name="fuel" id="model_id" class="form-control select-bg @error('fuel') border-danger @enderror">
                                                    <option value="" hidden>Select Fuel Type</option>
                                                    @isset($ad->vehicleFeatures->fuel_type)
                                                        @foreach ($fuels as $fuel)
                                                            <option {{ $fuel->name == $ad->vehicleFeatures->fuel_type ? 'selected':'' }} value="{{ $fuel->name }}">{{ $fuel->name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($fuels as $fuel)
                                                            <option {{ old('fuel') == $fuel->name ? 'selected':'' }} value="{{$fuel->name }}">{{ $fuel->name }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                    </div>

                                    <div class="col-sm-4 cars-and-bikes">
                                            <div class="input-select">
                                                <label for="brand">Title Status <span class="text-danger">*</span></label>
                                                <select required name="title_status" id="title_status" class="form-control select-bg @error('title_status') border-danger @enderror">
                                                    <option value="" hidden>Select Title Status</option>
                                                    @isset($ad->vehicleFeatures->title_status)
                                                        @foreach ($title_statuses as $title_status)
                                                            <option {{ $title_status->name == $ad->vehicleFeatures->title_status ? 'selected':'' }} value="{{ $title_status->name }}">{{ $title_status->name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($title_statuses as $title_status)
                                                            <option {{ old('title_status') == $title_status->name ? 'selected':'' }} value="{{ $title_status->name }}">{{ $title_status->name }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                    </div>

                                    <div class="col-sm-4 only-cars">
                                            <div class="input-select  ">
                                                <label for="brand">Drives <span class="text-danger">*</span></label>
                                                <select required name="drive" id="drive" class="form-control select-bg @error('model') border-danger @enderror">
                                                    <option value="" hidden>Select Drives</option>
                                                    @isset($ad->vehicleFeatures->drive)
                                                        @foreach ($drives as $drive)
                                                            <option {{ $drive->name == $ad->vehicleFeatures->drive ? 'selected':'' }} value="{{ $drive->name }}">{{ $drive->name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($drives as $drive)
                                                            <option {{ old('drive') == $drive->name ? 'selected':'' }} value="{{ $drive->name }}">{{ $drive->name }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                    </div>





                                    <div class="col-sm-4">
                                            <div class="input-select col-lg-4">
                                                <label for="authenticityy">Authenticity <span class="text-danger">*</span></label>
                                                <select required name="authenticity" id="authenticityy" class="form-control select-bg @error('authenticity') border-danger @enderror">
                                                    @isset($ad->authenticity)
                                                        <option {{ $ad->authenticity == 'original'? 'selected':'' }} value="original">Original</option>
                                                        <option {{ $ad->authenticity == 'refurbished'? 'selected':'' }} value="refurbished">Refurbished</option>
                                                    @else
                                                        <option value="original">Original</option>
                                                        <option value="refurbished">Refurbished</option>
                                                    @endisset
                                                </select>
                                            </div>
                                    </div>

                                    <div class="col-sm-4 cars-and-bikes">
                                            <div class="input-field   ">
                                                <label for="mileage"> Mileage <span class="text-danger">*</span></label>
                                                <input required value="{{ $ad->vehicleFeatures->mileage ?? '' }}" name="mileage" type="number" min="1" placeholder="milage" id="mileage"  class="@error('mileage') border-danger @enderror"/>
                                            </div>
                                    </div>

                                    <div class="col-sm-4  cars-and-bikes">
                                            <div class="input-field   ">
                                                <label for="vin"> Vin <span class="text-danger">*</span></label>
                                                <input  value="{{ $ad->vehicleFeatures->vin ?? '' }}" name="vin" type="number" min="1" placeholder="vin" id="vin"  class="@error('vin') border-danger @enderror"/>
                                            </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="input-field--textarea">
                                            <label for="description">Ad description</label>
                                            @isset($ad->description)
                                                <textarea required  value="{{ $ad->description ?? '' }}"  name="description" placeholder="Description of what you are listing..." id="description" class="@error('description') border-danger @enderror">{{ $ad->description ?? '' }}</textarea>
                                            @else
                                                 <textarea required name="description" value="{{old('description')}}" placeholder="Description of what you are listing..." id="description" class="@error('description') border-danger @enderror">{{ old('description') }}</textarea>
                                            @endisset
                                        </div>
                                    </div>





                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input name="negotiable" type="hidden" value="0">
                                        @isset($ad->negotiable)
                                            <input {{ $ad->negotiable == 1 ? 'checked':'' }} value="1" name="negotiable" type="checkbox" class="form-check-input" id="checkme" />
                                        @else
                                            <input value="1" name="negotiable" type="checkbox" class="form-check-input" id="checkme" />
                                        @endisset
                                        <label class="form-check-label" for="checkme">negotiable </label>
                                    </div>
                                </div>
                                @if (session('user_plan')->featured_limit)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input name="featured" type="hidden" value="0">
                                            @isset($ad->featured)
                                                <input {{ $ad->featured == 1 ? 'checked':'' }} value="1" name="featured" type="checkbox" class="form-check-input" id="featured" />
                                            @else
                                                <input value="1" name="featured" type="checkbox" class="form-check-input" id="featured" />
                                            @endisset
                                            <label class="form-check-label" for="featured">Featured </label>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            </div>
                        </div>



                <div class="dashboard-post__action-btns">
                    <a href="{{ route('frontend.post.rules') }}" class="btn btn--lg btn--outline">
                        View Posting Rules
                    </a>
                    <button type="submit" class="btn btn--lg">
                        Next Steps
                        <span class="icon--right">
                            <x-svg.right-arrow-icon />
                        </span>
                    </button>
                </div>
            </form>

            
        </div>
    </div>
@endsection
