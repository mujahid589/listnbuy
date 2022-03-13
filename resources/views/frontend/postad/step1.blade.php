@extends('frontend.postad.index')

@section('title', __('website.step1'))

@section('post-ad-content')
    <style>

        ul.nav.dashboard-post__nav.mb-3 {
            display: none;
        }

        .wizard-content .wizard>.steps>ul>li:after,
        .wizard-content .wizard>.steps>ul>li:before {
            content: '';
            z-index: 9;
            display: block;
            position: absolute
        }

        .wizard-content .wizard {
            width: 100%;
            overflow: hidden
        }

        .wizard-content .wizard .content {
            margin-left: 0!important
        }

        .wizard-content .wizard>.steps {
            position: relative;
            display: block;
            width: 100%;
            border-bottom: 1px solid #d5d0d0;
            padding: 1px;
        }

        .wizard-content .wizard>.steps .current-info {
            position: absolute;
            left: -99999px
        }

        .wizard-content .wizard>.steps>ul {
            display: table;
            width: 100%;
            table-layout: fixed;
            margin: 0;
            padding: 0;
            list-style: none
        }

        .wizard-content .wizard>.steps>ul>li {
            display: table-cell;
            width: auto;
            vertical-align: top;
            text-align: center;
            position: relative
        }

        .wizard-content .wizard>.steps>ul>li a {
            position: relative;
            padding-top: 52px;
            margin-top: 20px;
            margin-bottom: 20px;
            display: block
        }

        .wizard-content .wizard>.steps>ul>li:before {
            left: 0
        }

        .wizard-content .wizard>.steps>ul>li:after {
            right: 0
        }

        .wizard-content .wizard>.steps>ul>li:first-child:before,
        .wizard-content .wizard>.steps>ul>li:last-child:after {
            content: none
        }

        .wizard-content .wizard>.steps>ul>li.current>a {
            color: #2f3d4a;
            cursor: default
        }

        .wizard-content .wizard>.steps>ul>li.current .step {
            border-color: #009efb ;
            background-color: #fff;
            color: #009efb
        }

        .wizard-content .wizard>.steps>ul>li.disabled a,
        .wizard-content .wizard>.steps>ul>li.disabled a:focus,
        .wizard-content .wizard>.steps>ul>li.disabled a:hover {
            color: #999;
            cursor: default
        }

        .wizard-content .wizard>.steps>ul>li.done a,
        .wizard-content .wizard>.steps>ul>li.done a:focus,
        .wizard-content .wizard>.steps>ul>li.done a:hover {
            color: #999
        }

        .wizard-content .wizard>.steps>ul>li.done .step {
            background-color: #009efb ;
            border-color: #009efb ;
            color: #fff
        }

        .wizard-content .wizard>.steps>ul>li.error .step {
            border-color: #f62d51;
            color: #f62d51
        }

        .wizard-content .wizard>.steps .step {
            background-color: #fff;
            display: inline-block;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -24px;
            z-index: 10;
            text-align: center
        }

        .wizard-content .wizard>.content {
            overflow: hidden;
            position: relative;
            width: auto;
            padding: 38px 0;
            margin: 0
        }

        .wizard-content .wizard>.content>.title {
            position: absolute;
            left: -99999px
        }

        .wizard-content .wizard>.content>.body {
            padding: 0 10px;
        }

        .wizard-content .wizard>.content>iframe {
            border: 0;
            width: 100%;
            height: 100%
        }

        .wizard-content .wizard>.actions {
            position: relative;
            display: block;
            text-align: right;
            padding: 0 10px 20px
        }

        .wizard-content .wizard>.actions>ul {
            float: right;
            list-style: none;
            padding: 0;
            margin: 0
        }

        .wizard-content .wizard>.actions>ul:after {
            content: '';
            display: table;
            clear: both
        }

        .wizard-content .wizard>.actions>ul>li {
            float: left
        }

        .wizard-content .wizard>.actions>ul>li+li {
            margin-left: 10px
        }

        .wizard-content .wizard>.actions>ul>li>a {
            background: #009efb ;
            color: #fff;
            display: block;
            padding: 7px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            min-width: 100px;
            text-align: center;
        }

        .wizard-content .wizard>.actions>ul>li>a:focus,
        .wizard-content .wizard>.actions>ul>li>a:hover {
            -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, .05) inset;
            box-shadow: 0 0 0 100px rgba(0, 0, 0, .05) inset
        }

        .wizard-content .wizard>.actions>ul>li>a:active {
            -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, .1) inset;
            box-shadow: 0 0 0 100px rgba(0, 0, 0, .1) inset
        }

        .wizard-content .wizard>.actions>ul>li>a[href="#previous"] {
            background-color: #fff;
            color: #009efb;
            border: 1px solid #009efb;
        }

        .wizard-content .wizard>.actions>ul>li>a[href="#previous"]:focus,
        .wizard-content .wizard>.actions>ul>li>a[href="#previous"]:hover {
            -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, .02) inset;
            box-shadow: 0 0 0 100px rgba(0, 0, 0, .02) inset
        }

        .wizard-content .wizard>.actions>ul>li>a[href="#previous"]:active {
            -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, .04) inset;
            box-shadow: 0 0 0 100px rgba(0, 0, 0, .04) inset
        }

        .wizard-content .wizard>.actions>ul>li.disabled>a,
        .wizard-content .wizard>.actions>ul>li.disabled>a:focus,
        .wizard-content .wizard>.actions>ul>li.disabled>a:hover {
            color: #999
        }

        .wizard-content .wizard>.actions>ul>li.disabled>a[href="#previous"],
        .wizard-content .wizard>.actions>ul>li.disabled>a[href="#previous"]:focus,
        .wizard-content .wizard>.actions>ul>li.disabled>a[href="#previous"]:hover {
            -webkit-box-shadow: none;
            box-shadow: none
        }

        .wizard-content .wizard.wizard-circle>.steps>ul>li:after,
        .wizard-content .wizard.wizard-circle>.steps>ul>li:before {
            top: 45px;
            width: 50%;
            height: 3px;
            background-color: #009efb
        }

        .wizard-content .wizard.wizard-circle>.steps>ul>li.current:after,
        .wizard-content .wizard.wizard-circle>.steps>ul>li.current~li:after,
        .wizard-content .wizard.wizard-circle>.steps>ul>li.current~li:before {
            background-color: #F3F3F3
        }

        .wizard-content .wizard.wizard-circle>.steps .step {
            width: 50px;
            height: 50px;
            line-height: 45px;
            border: 3px solid #F3F3F3;
            font-size: 1.3rem;
            border-radius: 50%
        }

        .wizard-content .wizard.wizard-notification>.steps>ul>li:after,
        .wizard-content .wizard.wizard-notification>.steps>ul>li:before {
            top: 39px;
            width: 50%;
            height: 2px;
            background-color: #009efb
        }

        .wizard-content .wizard.wizard-notification>.steps>ul>li.current .step {
            border: 2px solid #009efb ;
            color: #009efb ;
            line-height: 36px
        }

        .wizard-content .wizard.wizard-notification>.steps>ul>li.current .step:after,
        .wizard-content .wizard.wizard-notification>.steps>ul>li.done .step:after {
            border-top-color: #009efb
        }

        .wizard-content .wizard.wizard-notification>.steps>ul>li.current:after,
        .wizard-content .wizard.wizard-notification>.steps>ul>li.current~li:after,
        .wizard-content .wizard.wizard-notification>.steps>ul>li.current~li:before {
            background-color: #F3F3F3
        }

        .wizard-content .wizard.wizard-notification>.steps>ul>li.done .step {
            color: #FFF
        }

        .wizard-content .wizard.wizard-notification>.steps .step {
            width: 40px;
            height: 40px;
            line-height: 40px;
            font-size: 1.3rem;
            border-radius: 15%;
            background-color: #F3F3F3
        }

        .wizard-content .wizard.wizard-notification>.steps .step:after {
            content: "";
            width: 0;
            height: 0;
            position: absolute;
            bottom: 0;
            left: 50%;
            margin-left: -8px;
            margin-bottom: -8px;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 8px solid #F3F3F3
        }

        .wizard-content .wizard.vertical>.steps {
            display: inline;
            float: left;
            width: 20%
        }

        .wizard-content .wizard.vertical>.steps>ul>li {
            display: block;
            width: 100%
        }

        .wizard-content .wizard.vertical>.steps>ul>li.current:after,
        .wizard-content .wizard.vertical>.steps>ul>li.current:before,
        .wizard-content .wizard.vertical>.steps>ul>li.current~li:after,
        .wizard-content .wizard.vertical>.steps>ul>li.current~li:before,
        .wizard-content .wizard.vertical>.steps>ul>li:after,
        .wizard-content .wizard.vertical>.steps>ul>li:before {
            background-color: transparent
        }

        @media (max-width:768px) {
            .wizard-content .wizard>.steps>ul {
                margin-bottom: 20px
            }
            .wizard-content .wizard>.steps>ul>li {
                display: block;
                float: left;
                width: 50%
            }
            .wizard-content .wizard>.steps>ul>li>a {
                margin-bottom: 0
            }
            .wizard-content .wizard>.steps>ul>li:first-child:before {
                content: ''
            }
            .wizard-content .wizard>.steps>ul>li:last-child:after {
                content: '';
                background-color: #009efb
            }
            .wizard-content .wizard.vertical>.steps {
                width: 15%
            }
        }

        @media (max-width:480px) {
            .wizard-content .wizard>.steps>ul>li {
                width: 50%;
            }
            .wizard-content .wizard>.steps>ul>li.current:after {
                background-color: #009efb;
            }
            .wizard-content .wizard.vertical>.steps>ul>li {
                display: block;
                float: left;
                width: 50%;
            }
            .wizard-content .wizard.vertical>.steps {
                width: 100%;
                float:none;
            }
        }
        

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
        .upload-wrapper2 .upload-area2 {
            padding: 20px;
            background: #ffffff;
            border: 1px dashed #ebeef7;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border-radius: 8px;
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .upload-wrapper2 .uploaded-items2 {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .upload-wrapper2 .add-new2 {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background: #f5f7fa;
            cursor: pointer;
            -ms-flex-negative: 0;
            flex-shrink: 0;
        }

        .upload-wrapper2 .uploaded-item2, .upload-wrapper2 .add-new2 {
            height: 120px;
            width: 120px;
            border-radius: 6px;
            position: relative;
            background: #f5f7fa;
            margin: 10px;
            -webkit-transition: background 0.3s linear;
            transition: background 0.3s linear;
        }

        .upload-wrapper2 .uploaded-item2 video,
        .upload-wrapper2 .add-new2 video {
            border-radius: 6px;
            /*height: 120px;*/
            /*width: 120px;*/
        }

        .upload-wrapper2 .uploaded-item2 .remove-icon {
            position: absolute;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background-color: #ff4f4f;
            color: white;
            right: 0;
            top: 0;
            -webkit-transform: rotate(45deg) translate(0%, -50%);
            transform: rotate(45deg) translate(0%, -50%);
            cursor: pointer;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .upload-wrapper2 .uploaded-item2 .remove-icon2 svg {
            height: 16px;
            width: 16px;
            pointer-events: none;
        }


        .upload-wrapper3 .upload-area3 {
            padding: 20px;
            background: #ffffff;
            border: 1px dashed #ebeef7;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border-radius: 8px;
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .upload-wrapper3 .uploaded-items3 {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .upload-wrapper3 .add-new3 {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background: #f5f7fa;
            cursor: pointer;
            -ms-flex-negative: 0;
            flex-shrink: 0;
        }

        .upload-wrapper3 .uploaded-item3, .upload-wrapper3 .add-new3 {
            height: 120px;
            width: 120px;
            border-radius: 6px;
            position: relative;
            background: #f5f7fa;
            margin: 10px;
            -webkit-transition: background 0.3s linear;
            transition: background 0.3s linear;
        }

        .upload-wrapper3 .uploaded-item3 img,
        .upload-wrapper3 .add-new3 img {
            border-radius: 6px;
        }

        .upload-wrapper3 .uploaded-item3 .remove-icon {
            position: absolute;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background-color: #ff4f4f;
            color: white;
            right: 0;
            top: 0;
            -webkit-transform: rotate(45deg) translate(0%, -50%);
            transform: rotate(45deg) translate(0%, -50%);
            cursor: pointer;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .upload-wrapper3 .uploaded-item3 .remove-icon svg {
            height: 16px;
            width: 16px;
            pointer-events: none;
        }

        button.stripe-button-el {
            display: none;
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
            <!-- <form novalidate action="{{ route('frontend.post.store') }}" method="POST">
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
            </form> -->

            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard" enctype="multipart/form-data" id='dynamic_form' method='post' >


                    <h5 style="display:none;"> Basic Info </h5>
                    <section style="padding:0;">
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

                                    <div class="col-sm-4" id="catag">
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

                    </section>
                    <!-- Step 2 -->
                    <h5 style="display:none;"> Upload Images And Video </h5>
                    <section style="padding:0;">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="upload-wrapper">
                                    <h3>Upload Thumbnail</h3>
                                    <div class="upload-area @error('thumbnail') border-danger @enderror">
                                        <div class="uploaded-items"></div>
                                        <div class="add-new">
                                            <x-svg.image-select-icon />
                                            <input name="thumbnail"  type="file" hidden id="addNew" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-5">
                                <div class="upload-wrapper2">
                                    <h3>Upload Video</h3>
                                    <div class="upload-area2 @error('video') border-danger @enderror">
                                        <div class="uploaded-items2"></div>
                                        <div class="add-new2">
                                            <x-svg.image-select-icon />
                                            <input name="video" type="file" hidden id="addNew2" accept="video/mp4,video/x-m4v,video/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-5" >
                                <div class="upload-wrapper3">
                                    <h3>Upload Photos</h3>
                                    <div class="upload-area3 @error('images') border-danger @enderror">
                                        <div class="uploaded-items3"></div>
                                        <div class="add-new3">
                                            <x-svg.image-select-icon />
                                            <input name="images[]" multiple type="file" hidden id="addNew3" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                    <h5 style="display:none;"> Review </h5>
                    <section style="padding:0;">
                        <div class="container-fluid">
                            <div class="row">

                                @forelse ($plans as $plan)
                                    <div class="d-none">

                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <div class="plan-card {{ $plan->recommended ? 'plan-card--active':'' }}">
                                            <div class="plan-card__top">
                                                <h2 class="plan-card__title text--body-1"> {{ $plan->label }} </h2>
                                                <p class="plan-card__description">
                                                    {{ $plan->description }}
                                                </p>
                                                <div class="plan-card__price">
                                                    <h5 class="text--display-3">${{ $plan->price }}</h5>
                                                </div>

                                                    {{--                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" id="stripe-button"--}}
                                                    {{--                                        data-key="{{ array_key_exists('STRIPE_KEY', $_SERVER) ? $_SERVER['STRIPE_KEY'] : env('STRIPE_KEY')}}" data-amount="{{ $plan->price*100 }}" data-name="{{ array_key_exists('APP_NAME', $_SERVER) ? $_SERVER['APP_NAME'] : env('APP_NAME')}}"--}}
                                                    {{--                                        data-description="ListnBuy Subscription"  data-locale="auto" data-currency="usd">--}}
                                                    {{--                                </script>--}}

                                                    <a  onclick="selectSubscriptionPlan( {{ $plan->id }}, {{ $plan->price }})"
                                                        id="subscription-button-{{ $plan->id}}"
                                                        class="btn btn-block btn-outline-primary plan-card__select-pack btn btn--bg w-100"
                                                    >
                                                        {{ __('website.choose_plan') }}
                                                        <span class="icon--right">
                                                            <x-svg.right-arrow-icon />
                                                        </span>
                                                    </a>

                                            </div>
                                            <div class="plan-card__bottom">
                                                <div class="plan-card__package">
                                                    <div class="plan-card__package-list active">
                                                        <span class="icon">
                                                            <x-svg.check-icon />
                                                        </span>
                                                        <h5 class="text--body-3">{{ __('website.post') }} {{ $plan->ad_limit }} {{ __('website.ads') }}</h5>
                                                    </div>
                                                    <div class="plan-card__package-list  {{ $plan->multiple_image ? 'active':'' }} ">
                                                        <span class="icon">
                                                            <x-svg.check-icon />
                                                        </span>
                                                        <h5 class="text--body-3"> {{ __('website.multiple_images') }} </h5>
                                                    </div>
                                                    <div class="plan-card__package-list {{ $plan->featured_limit ? 'active':'' }}">
                                                        <span class="icon">
                                                            <x-svg.check-icon />
                                                        </span>
                                                        <h5 class="text--body-3">{{ $plan->featured_limit }} {{ __('website.featured_ads') }}</h5>
                                                    </div>
                                                    <div class="plan-card__package-list {{ $plan->customer_support ? 'active':'' }} ">
                                                        <span class="icon">
                                                            <x-svg.check-icon />
                                                        </span>
                                                        <h5 class="text--body-3">{{ __('website.basic_customer_support') }}</h5>
                                                    </div>
                                                    <div class="plan-card__package-list {{ $plan->badge? 'active':'' }} ">
                                                        <span class="icon">
                                                            <x-svg.check-icon />
                                                        </span>
                                                        <h5 class="text--body-3">{{ __('website.special_membership_badge') }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <x-no-data-found/>
                                @endforelse
                            </div>
                        </div>

                        <input type="hidden" name="amount" value="0">
                        <input type="hidden" id="plan_id" name="plan_id" value="0">

                    </section>
                    
                </form>
            </div>

            <div class="modal" tabindex="-1" id="sucessmodal">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Success message</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body" style="display: flex;align-items: center;justify-content: center">
                             <p>Thank you you have upgraded you plan and submitted your post</p>
                         </div>

                     </div>
                 </div>
            </div>

            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js" integrity="sha512-gH0SqyjTN7WJAtki1UvqOkhWi3WsF9LY05BMwdcSq6QdFDXrXeXy0q8iP0YmBXCqo7OnSgdIPrC5Vqn8/KRu/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_51JZxd1FyqW4x6na2szRpArr1kGMvWd4l9GvH9FZPSxBRxYk7O6LMjoGhcn55SCZernU1QKDWyWvrFM22eWVc3XAr00p3KQ6d11" data-amount="0" data-name="{{ env('APP_NAME') }}"
            data-description="Money pay with stripe" data-locale="auto" data-currency="usd">
    </script>

    <script type="text/javascript">

        $(".tab-wizard").steps({
            headerTag: "h5",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Add"
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                $('.steps .current').prevAll().addClass('disabled');
            },
            onFinished: function (event, currentIndex) {
                $('#form').submit();
            }
        });

        function add_features_field() {
            $("#multiple_feature_part").append(`
            <div class="row">
                <div class="col-lg-10">
                        <div class="input-field">
                            <input name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                        </div>
                </div>
                <div class="col-lg-2 mt-10">
                    <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                </div>
            </div>
        `);
        }

        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent('div').remove();
        });

        // File Upload
        const uploadArea2 = document.querySelector('.upload-area2');
        const uploadedItems2 = document.querySelector('.uploaded-items2');
        const input2 = document.querySelector('#addNew2');
        const inputButton2 = document.querySelector('.add-new2');

        // add new file
        if (inputButton2) {
            inputButton2.addEventListener('click', (event) => {
                handleDragArea2(true);
                input2.click();
            });
        }

        // display file on file upload
        if (input2) {
            input2.addEventListener('change', (event) => {
                let files = event.target.files;

                for (let i = 0; i < files.length; i++) {
                    displayFile2(files[i]);
                    handleDragArea2(false);
                }
            });
        }

        // dragover event
        if (uploadArea2) {
            uploadArea2.addEventListener('dragover', (event) => {
                handleDragArea2(true);
                event.preventDefault();
            });
        }

        // dragleave event
        if (uploadArea2) {
            uploadArea2.addEventListener('dragleave', (event) => {
                handleDragArea2(false);
            });
        }

        // drop event
        if (uploadArea2) {
            uploadArea2.addEventListener('drop', (event) => {
                event.preventDefault();
                let file = event.dataTransfer.files[0];
                displayFile2(file);
            });
        }

        // Handle drag over and drag leave effect
        function handleDragArea2(param) {
            if (param == true) {
                uploadArea2.classList.add('active');
            } else {
                uploadArea2.classList.remove('active');
            }
        }

        // display uploadedFile
        function displayFile2(file) {
            let fileType = file.type;
            let validExtensions = ['video/mp4','video/x-m4v','video/*'];
            let fileURL;

            if (validExtensions.includes(fileType)) {
                let fileReader = new FileReader();

                fileReader.onload = () => {
                    fileURL = fileReader.result;
                    addNewfile2(fileURL);
                };
                fileReader.readAsDataURL(file);
            } else {
                alert('File type not supported');
                handleDragArea2(false);
            }
        }

        // Append New File in HTML
        function addNewfile2(file) {
            let imgTag = `
                <div class="uploaded-item2">
                    <video  width="120" height="120"  autoplay  >
                      <source src="${file}" >
                    </video>
                    <div class="remove-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </div>
                </div>`;
            uploadedItems2.insertAdjacentHTML('beforeend', imgTag);
        }

        $(document).on('click', '.remove-icon', function () {
            $(this).closest('.uploaded-item2').remove()
        });

        // File Upload
        const uploadArea3 = document.querySelector('.upload-area3');
        const uploadedItems3 = document.querySelector('.uploaded-items3');
        const input3 = document.querySelector('#addNew3');
        const inputButton3 = document.querySelector('.add-new3');

        // add new file
        if (inputButton3) {
            inputButton3.addEventListener('click', (event) => {
                handleDragArea3(true);
                input3.click();
            });
        }

        // display file on file upload
        if (input3) {
            input3.addEventListener('change', (event) => {
                let files = event.target.files;

                for (let i = 0; i < files.length; i++) {
                    displayFile3(files[i]);
                    handleDragArea3(false);
                }
            });
        }

        // dragover event
        if (uploadArea3) {
            uploadArea3.addEventListener('dragover', (event) => {
                handleDragArea3(true);
                event.preventDefault();
            });
        }

        // dragleave event
        if (uploadArea3) {
            uploadArea3.addEventListener('dragleave', (event) => {
                handleDragArea3(false);
            });
        }

        // drop event
        if (uploadArea3) {
            uploadArea3.addEventListener('drop', (event) => {
                event.preventDefault();
                let file = event.dataTransfer.files[0];
                displayFile3(file);
            });
        }

        // Handle drag over and drag leave effect
        function handleDragArea3(param) {
            if (param == true) {
                uploadArea3.classList.add('active');
            } else {
                uploadArea3.classList.remove('active');
            }
        }

        // display uploadedFile
        function displayFile3(file) {
            let fileType = file.type;
            let validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
            let fileURL;

            if (validExtensions.includes(fileType)) {
                let fileReader = new FileReader();

                fileReader.onload = () => {
                    fileURL = fileReader.result;
                    addNewfile3(fileURL);
                };
                fileReader.readAsDataURL(file);
            } else {
                alert('File type not supported');
                handleDragArea3(false);
            }
        }

        // Append New File in HTML
        function addNewfile3(file) {
            let imgTag = `
                <div class="uploaded-item3">
                    <img src="${file}" alt="">
                    <div class="remove-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </div>
                </div>`;
            uploadedItems3.insertAdjacentHTML('beforeend', imgTag);
        }

        $(document).on('click', '.remove-icon', function () {
            $(this).closest('.uploaded-item3').remove()
        });

        // File Upload
        const uploadArea = document.querySelector('.upload-area');
        const uploadedItems = document.querySelector('.uploaded-items');
        const input = document.querySelector('#addNew');
        const inputButton = document.querySelector('.add-new');

        // add new file
        if (inputButton) {
            inputButton.addEventListener('click', (event) => {
                handleDragArea(true);
                input.click();
            });
        }

        // display file on file upload
        if (input) {
            input.addEventListener('change', (event) => {
                let files = event.target.files;

                for (let i = 0; i < files.length; i++) {
                    displayFile(files[i]);
                    handleDragArea(false);
                }
            });
        }

        // dragover event
        if (uploadArea) {
            uploadArea.addEventListener('dragover', (event) => {
                handleDragArea(true);
                event.preventDefault();
            });
        }

        // dragleave event
        if (uploadArea) {
            uploadArea.addEventListener('dragleave', (event) => {
                handleDragArea(false);
            });
        }

        // drop event
        if (uploadArea) {
            uploadArea.addEventListener('drop', (event) => {
                event.preventDefault();
                let file = event.dataTransfer.files[0];
                displayFile(file);
            });
        }

        // Handle drag over and drag leave effect
        function handleDragArea(param) {
            if (param == true) {
                uploadArea.classList.add('active');
            } else {
                uploadArea.classList.remove('active');
            }
        }

        // display uploadedFile
        function displayFile(file) {
            let fileType = file.type;
            let validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
            let fileURL;

            if (validExtensions.includes(fileType)) {
                let fileReader = new FileReader();

                fileReader.onload = () => {
                    fileURL = fileReader.result;
                    addNewfile(fileURL);
                };
                fileReader.readAsDataURL(file);
            } else {
                alert('File type not supported');
                handleDragArea(false);
            }
        }

        // Append New File in HTML
        function addNewfile(file) {
            let imgTag = `
            <div class="uploaded-item">
                <img src="${file}" alt="">
                <div class="remove-icon">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </div>
            </div>`;
            uploadedItems.insertAdjacentHTML('beforeend', imgTag);
        }

        $(document).on('click', '.remove-icon', function () {
            $(this).closest('.uploaded-item').remove()
        });

        var token = function(res){

            console.log(res);

            var sucessModal = new bootstrap.Modal(document.getElementById("sucessmodal"), {})
            sucessModal.show()
            var $input = $('<input type=hidden name=stripeToken />').val(res.id);

            // // show processing message, disable links and buttons until form is submitted and reloads
            // $('a').bind("click", function() { return false; });
            // $('button').addClass('disabled');
            // $('.overlay-container').show();

            // // submit form
            // // $('.form-stripe').append($input).submit();
            // $('#form_id').trigger("reset");
            $('#dynamic_form').submit();
        };

        $(document).ready(function (e) {

            $('#dynamic_form').on('submit',(function(e) {

                e.preventDefault();

                var data = new FormData(this);

                console.log(data);

                $.ajax({

                    type:'POST',

                    url: '{{ route('frontend.post.store') }}',

                    data:new FormData(this),

                    contentType: false,

                    cache: false, 

                    processData: false,

                    success:function(data){

                        console.log("success");
                        if (data == 1) {
                        }

                        // myData=JSON.parse(data);

                    },

                    error: function(data){

                        console.log("error");

                        console.log(data);

                    }

                });

                

            }));

        });

        function selectSubscriptionPlan(plan_id, display_price) {
            selectedSubscriptionPlan = display_price;
            $('[name="plan_id"]').val(plan_id);
            $("[id^=subscription-button-]").removeClass('btn-primary')
            $("[id^=subscription-button-]").addClass('btn-outline-primary')
            $('#subscription-button-' + plan_id).removeClass('btn-outline-primary')
            $('#subscription-button-' + plan_id).addClass('btn-primary')
            //e.preventDefault();
            //$('.stripe-button-el').click();
             // StripeCheckout.__app.configurations.button0.amount = parseFloat(display_price) * 100;
            $('#stripe-button').attr("data-amount", parseFloat(display_price) * 100); //setter

            StripeCheckout.open({
                key:         'pk_test_51JZxd1FyqW4x6na2szRpArr1kGMvWd4l9GvH9FZPSxBRxYk7O6LMjoGhcn55SCZernU1QKDWyWvrFM22eWVc3XAr00p3KQ6d11',
                amount:      (parseFloat(display_price) * 100),
                name:        "pay to list and buy",
                image:       'https://res.cloudinary.com/kavitdigital/image/upload/v1/listnbuy/public/website/1645142925_620ee38dace32.jpg',
                description: "",
                panelLabel:  'Checkout',
                token:       token
            });
           // $('.stripe-button-el').click();
           // submitStepForm()
        }



        function add_features_field() {
            $("#multiple_feature_part").append(`
                <div class="row">
                    <div class="col-lg-10">
                            <div class="input-field">
                                <input name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                            </div>
                    </div>
                    <div class="col-lg-2 mt-10">
                        <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            `);
        }

        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent('div').remove();
        });

    </script>

@endsection

