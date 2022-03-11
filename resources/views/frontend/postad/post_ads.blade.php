@extends('layouts.frontend.layout_one')

@section('title')
    Create Ads
@endsection

@section('frontend_style')
    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/dropzone/dist/min/dropzone.min.css')}}">
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            /* display: flex; */
            padding: 5px 5px 0px 5px;
            position: relative;
            overflow: auto;
        }

        .preview-images-zone>.preview-image:first-child {
            height: 185px;
            width: 185px;
            position: relative;
            margin-right: 5px;
        }

        .preview-images-zone>.preview-image {
            height: 90px;
            width: 90px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }

        .preview-images-zone>.preview-image>.image-zone {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone>.preview-image>.image-zone>img {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone>.preview-image>.tools-edit-image {
            position: absolute;
            z-index: 100;
            color: #fff;
            bottom: 0;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
            display: none;
        }

        .preview-images-zone>.preview-image>.image-cancel {
            font-size: 18px;
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
            display: none;
            z-index: 100;
        }

        .preview-image:hover>.image-zone {
            cursor: move;
            opacity: .5;
        }

        .preview-image:hover>.tools-edit-image,
        .preview-image:hover>.image-cancel {
            display: block;
        }

        .ui-sortable-helper {
            width: 90px !important;
            height: 90px !important;
        }

        .container {
            padding-top: 50px;
        }
    </style>
    {{-- Stles Hack --}}
    <style>
        .wizard>.content {
            min-height: 35em !important;
        }

        .wizard > .steps {
            display: none !important;
        }

        .wizard > .content > .body {
            position: unset !important;
        }

        .filepond--list li {
            display: unset !important;
        }

        .pricing-table .pricing-card .pricing-card-body {
            padding: 20px !important;
            list-style: none;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        ul.list-unstyled.plan-features {
            list-style: none !important;

        }

        .list-out {
            text-align: center !important;
            font-weight: bold !important;
            font-size: 0.9em !important;
        }

        .list-out-no {
            text-align: center !important;
            font-weight: bold !important;
            font-size: 0.9em !important;
            color: #9b0101 !important;
        }

        .list-dis {
            text-align: center !important;
            font-size: 1.2em !important;
            color: #2f8ee0 !important;
            padding: 5px 5px 5px 5px;
        }

        .select2-container--bootstrap .select2-selection--single {
            height: 2.875rem !important;
            padding: 12px 12px !important;
        }

        .select2-container--bootstrap {
            width: 100% !important;
        }

        button.stripe-button-el {
            visibility: hidden !important;
        }
    </style>

    <style>
        .loader-container-inner {
            position: absolute;
            visibility: hidden;
            z-index: 10;
            top: 50%;
            left: 50%;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            margin-left: -4em;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .circle-text-plan {
            display: table-cell;
            height: 300px;
            width: 300px;
            text-align: center;
            vertical-align: middle;
            border-radius: 50%;
            background: #FCE51F;
            color: #3f3c4e;
            font: 18px sans-serif;
            margin: auto;
            opacity: 0.7;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .circle-text-plan h1 {
            color: #fff;
        }

        .circle-text-post {
            display: table-cell;
            height: 300px;
            width: 300px;
            text-align: center;
            vertical-align: middle;
            border-radius: 50%;
            background: #76CB19;
            color: #3f3c4e;
            font: 18px sans-serif;
            margin: auto;
            opacity: 0.7;
            display: flex;
            justify-content: center;
            align-items: center;


        }

        .circle-text-post h1 {
            color: #fff;
            font-size: 6em;
        }

        .heading {
            background-color: #fff;
            opacity: 0.7;
            width: 100%;
            text-align: center;
            padding: 5px 5px 5px 5px;
            font-size: 1.8em;

        }

        .heading span {
            color: #2585f2;
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold !important;
        }
    </style>

    <script>
        // $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
        // $(window).on('load', function(){
        //     setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
        // });

        //     .main-panel:before {
        //     height: 100%;
        //     width: 100%;
        //     content: "df";
        //     position: absolute;
        //     background-color: black;
        //     z-index: 1;
        //     opacity: .5;
        // }

        // function removeLoader(){
        //     alert("loding complete")
        //     $( "#loadingDiv" ).fadeOut(500, function() {
        //     // fadeOut complete. Remove the loading div
        //     $( "#loadingDiv" ).remove(); //makes page more lightweight
        // });
        // }
    </script>

@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
{{--            @include('listnbuy_seller.partials.advert_credit_balance', ['active_plan' => $current_plan['active_plan'],--}}
{{--            'available_units' => $current_plan["available_units"]])--}}
            <div class="col-sm-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success text-center"
                         style="font-size: calc(14px + (26 - 14) * ((100vw - 300px) / (1600 - 300))) !important;" role="alert">
                        <p>Advert has been created - <a href="{{ Session::get('url') }}">View advert</a></p>
                    </div>
                @endif
            </div>
            <div class="col-12 grid-margin">
                <div class="loader-container-inner">
                    <div class="loader"></div>
                </div>

                <div class="container" style="margin-bottom: 40px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Ads</h4>
                                    <form id="create-post-form" enctype="multipart/form-data" method="POST"   >
                                        {{--                              action="{{ route('seller.app.create_post') }}">--}}
                                        {{ csrf_field() }}
                                        <div>
                                            <h3>Data Entry</h3>
                                            <section id="data-entry">
                                                <h3>Basic Information</h3>
                                                <p><i>Fields marked (<b class="text-danger">*</b>) are required</i></p>
                                                <br />
                                                <br />

                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> What are you listing?</label>
                                                            <select name="category_id" id="category_id"
                                                                    class="form-control is_required">
                                                                <option value="">--- Select Below ---</option>
                                                                @foreach ($categories as $category)
                                                                    <option {{ old('category_id') == $category->id ? "selected" : "" }}
                                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a category</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 hide-on-general">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Model Year</label>
                                                            <select name="model_year" class="form-control" id="model_year">
                                                                <option value="">--- Select Below ---</option>
                                                                @for ($i = 1901; $i < 2050; $i++)
                                                                    <option {{ old('model_year') == $i || date('Y') == $i ? "selected" : "" }} value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid year</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> <span id="classificationSelectTitle"></span></label>
                                                            <select name="type_id" class="form-control  is_required" id="type_id">
                                                                <option value="">--- Select Below ---</option>
                                                            </select>
                                                            <div class="invalid-feedback">Please select a vehicle type</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b>  <span id="makeSelectTitle"></span></label>
                                                            <select name="make_id" class="form-control is_required" id="make_id">
                                                                <option value="">--- Select Below ---</option>
                                                            </select>
                                                            <div class="invalid-feedback">Please select a make</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> <span id="modelInputTitle"></span></label>
                                                            <input type="text" name="model_id" class="form-control is_required" id="model_id"
                                                                   class="form-control" aria-describedby="emailHelp" placeholder="Select / Enter" list="type_list">
                                                            <datalist id="type_list"></datalist>
                                                            <div class="invalid-feedback">Please select a valid item category</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 only-parts">
                                                        <div class="form-group">
                                                            <label>Model Number <i>(optional)</i></label>
                                                            <input type="text" name="model_number" id="model_number"
                                                                   value="{{ old('model_number') }}" class="form-control"
                                                                   aria-describedby="emailHelp" placeholder="Enter model number">
                                                            <div class="invalid-feedback">Please enter a valid model number</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 cars-and-bikes">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Mileage (miles)</label>
                                                            <input type="number" min="1" value="{{ old('mileage') }}" name="mileage"
                                                                   id="mileage" class="form-control is_required"
                                                                   aria-describedby="emailHelp" placeholder="Enter vehicle milege">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 cars-and-bikes">
                                                        <div class="form-group">
                                                            <label>VIN <i>(optional)</i></label>
                                                            <input type="number" min="1" value="{{ old('vin') }}" name="vin"
                                                                   class="form-control" aria-describedby="emailHelp"
                                                                   placeholder="Enter vehicle identification number">
                                                            <div class="invalid-feedback">Please enter a valid VIN</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 only-bikes">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Engine Displacement (cc)</label>
                                                            <input type="number" min="1" name="engine_displacement"
                                                                   value="{{ old('engine_displacement') }}"
                                                                   class="form-control is_required" aria-describedby="emailHelp"
                                                                   placeholder="Enter engine displacement (cc)">
                                                            <div class="invalid-feedback">Please enter a CC</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 cars-and-bikes">
                                                        <div class="form-group">
                                                            <label>Engine Size <i>(optional)</i></label>
                                                            <input type="text" name="engine_size" value="{{ old('engine_size') }}"
                                                                   class="form-control" aria-describedby="emailHelp"
                                                                   placeholder="Enter engine size">
                                                            <div class="invalid-feedback">Please enter a valid engine size</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 cars-and-bikes">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Transmission type</label>
                                                            <select name="transmission_id" class="form-control is_required" id="">
                                                                <option value="">--- Select Below ---</option>
                                                                @foreach ($transmissions as $transmission)
                                                                    <option
                                                                        {{ old('transmission_id') == $transmission->id ? "selected" : "" }}
                                                                        value="{{ $transmission->id }}">{{ $transmission->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid transmission</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 cars-and-bikes">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Fuel Type </label>
                                                            <select name="fuel_id" class="form-control is_required" id="">
                                                                <option value="">--- Select Below ---</option>
                                                                @foreach ($fuels as $fuel)
                                                                    <option {{ old('fuel_id') == $fuel->id ? "selected" : "" }}
                                                                            value="{{ $fuel->id }}">
                                                                        {{ $fuel->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid fuel type</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Condition </label>
                                                            <select name="condition_id" class="form-control is_required" id="">
                                                                <option value="">--- Select Below ---</option>
                                                                @foreach ($conditions as $condition)
                                                                    <option {{ old('condition_id') == $condition->id ? "selected" : "" }}
                                                                            value="{{ $condition->id }}">{{ $condition->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid condition</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 cars-and-bikes">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Title Status</label>
                                                            <select name="title_status_id" class="form-control is_required" id="">
                                                                <option value="">--- Select Below ---</option>
                                                                @foreach ($title_statuses as $title_status)
                                                                    <option
                                                                        {{ old('title_status_id') == $title_status->id ? "selected" : "" }}
                                                                        value="{{ $title_status->id }}">{{ $title_status->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a title status</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 only-cars">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Drive line type</label>
                                                            <select name="drive_id" class="form-control is_required" id="">
                                                                <option value="">--- Select Below ---</option>
                                                                @foreach ($drives as $drive)
                                                                    <option {{ old('drive_id') == $drive->id ? "selected" : "" }}
                                                                            value="{{ $drive->id }}">
                                                                        {{ $drive->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a drive line</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <h3>Description</h3>
                                            <section>
                                                <h3>Vehicle Location</h3>
                                                <p><i>Fields marked (<b class="text-danger">*</b>) are required</i></p>
                                                <br />
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> State</label>
                                                            <select name="state_id" class="form-control is_required" id=""></select>
                                                            <div class="invalid-feedback">Please select a valid state</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> City</label>
                                                            <select name="city_id" class="form-control is_required" id=""></select>
                                                            <div class="invalid-feedback">Please select a valid city</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Postal Code</label>
                                                            <input type="number" min="1" name="postal_code"
                                                                   value="{{ old('postal_code') }}" class="form-control is_required"
                                                                   aria-describedby="emailHelp" placeholder="Postal code">
                                                            <div class="invalid-feedback">Please enter a valid postal code</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <h3>Description and Price</h3>
                                                <p><i>Fields marked (<b class="text-danger">*</b>) are required</i></p>
                                                <br />
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label><b class="text-danger">*</b> Price ($)</label>
                                                                    <input type="number" min="1" name="price"
                                                                           value="{{ old('postal_code') }}"
                                                                           class="form-control is_required" aria-describedby="emailHelp"
                                                                           placeholder="Price ($)">
                                                                    <div class="invalid-feedback">Please enter a valid price</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 ">
                                                                <div class="form-group">
                                                                    <label>Suggested Retail ($)</label>
                                                                    <input type="number" min="1" name="suggested_retail"
                                                                           value="{{ old('suggested_retail') }}" class="form-control"
                                                                           aria-describedby="emailHelp"
                                                                           placeholder="Suggested Retail Price ($)">
                                                                    <div class="invalid-feedback">Please enter a valid price</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label><b class="text-danger">*</b> Full Description</label>
                                                            <div class="invalid-feedback">Please enter a valid description</div>
                                                            <textarea name="description" class="form-control is_required" cols="30" rows="10"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <h3>Media Files</h3>
                                            <section>
                                                <br>
                                                <h3>Upload Image & Video Files</h3>
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label><b class="text-danger">*</b> Upload main image</label>
                                                                <fieldset class="form-group">
                                                                    <div id="mainimagedropzone" class="dropzone"></div>
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Upload other images <i>(optional)</i></label>
                                                                <fieldset class="form-group">
                                                                    <div id="myimagedropzone" class="dropzone"></div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="invalid-feedback">Please upload atleast 1 image</div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label>Upload Video <i>(optional)</i></label>
                                                            <fieldset class="form-group">
                                                                <div id="myvideodropzone" class="dropzone">
                                                                    <video id="preview" style="width: 100%;" controls autoplay
                                                                           loop></video>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <h3>Publish</h3>
                                            <section>
                                                <h3 style="text-align:center;">Subscription Plan</h3>
                                                <br />
                                                @if (isset(Auth::user()->userPlan) && Auth::user()->userPlan && Auth::user()->userPlan->ad_limit > 0)
                                                    <div class="row mt-1">
                                                        <div class="col-sm">
                                                            <div class="circle-text-plan ">
                                                                <table>
                                                                    <tr>
                                                                        <td>
                                                                            <h2>You're On:</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h1>{{ Auth::user()->userPlan->label }}</h1>
                                                                        </td>
                                                                    </tr>
                                                                </table>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm d-flex justify-content-center">
                                                            <img src="{{ asset('assets/images/listnbuy/listoon.png') }}" height="400px"
                                                                 alt="img">
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="circle-text-post ">
                                                                <table>
                                                                    <tr>
                                                                        <td>
                                                                            <h2>You Have:</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h1>+{{ Auth::user()->userPlan->ad_limit }}</h1>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h3>POST(S)</h3>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="plan_id" value="{{ Auth::user()->userPlan->id }}"
                                                           class="form-control">
                                                @else
                                                    <div class="row pricing-table">
                                                        <div class="invalid-feedback">Please select a valid subscription plan</div>
                                                        <input type="hidden" name="plan_id" class="form-control">

                                                        <div class="tab-content" id="nav-tabContent">
                                                            <!-- Monthly -->
                                                            <div class="tab-pane fade show active" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                                                                <div class="row">
                                                                    @forelse ($plans as $plan)
                                                                        <x-others.single-plan :plan="$plan"  />
                                                                    @empty
                                                                        <x-no-data-found/>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <p class="list-dis"><span style="color:#000000;">Please Note:</span> (These plans are
                                                        subject to a
                                                        future change with a 30 days notification to all sellers)</p>
                                                @endif
                                            </section>
                                        </div>
                                        @if (isset(Auth::user()->userPlan) && Auth::user()->userPlan && Auth::user()->userPlan->ad_limit > 0
                                        )

                                        @else
                                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" id="stripe-button"
                                                    data-key="{{ env('STRIPE_KEY') }}" data-amount="0" data-name="{{ Auth::user()->name }}"
                                                    data-description="ListnBuy Subscription"></script>
                                        @endif
                                        <input type="hidden" id="post_id" name="post_id" value="" />
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    @endsection

    @section('frontend_script')

        <!-- Plugin js for this page-->
            <script src="{{asset('vendors/jquery-steps/jquery.steps.min.js') }}"></script>
            <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
            <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
            <script src="{{asset('vendors/dropzone/dist/min/dropzone.min.js')}}"></script>

            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

            {{-- Declaration of variables --}}
            <script>
                var step_one_completed = false;
                var step_two_completed = false;
                var step_three_completed = false;
                var post_id = null;
                var selectedSubscriptionPlan = null;

            </script>


            <!-- DropZone -->
            <script type="text/javascript">
                Dropzone.autoDiscover = false;

                $(document).ready(function () {

                    var myimagedropzone = $("#myimagedropzone").dropzone({
                        maxFiles: 30,
                        acceptedFiles: "image/*",
                        addRemoveLinks: true,
                        timeout: 180000,
                        dictDefaultMessage: "click to upload other pictures...",
                        url: "{{ route('frontend.post.images.upload') }}",
                        init: function() {
                            this.on("success", function(file, response) {
                                file.serverId = response;
                                $('#myimagedropzone').append('<input type="hidden" id="image_'+response+'" name="images" value="'+response+'" />');
                            });
                            this.on("removedfile", function(file) {
                                if (!file.serverId) {
                                    var _ref;
                                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                                }

                                // data
                                var data = { 'id': file.serverId, 'post_id': post_id }

                                // delete request
                                $.ajax({
                                    url: '{{ route('frontend.post.images.upload') }}',
                                    data: data,
                                    type: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (result) {
                                        $("#image_" + file.serverId).remove();
                                        // var _ref;
                                        // return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                                    }
                                });
                            });
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var mainimagedropzone = $("#mainimagedropzone").dropzone({
                        maxFiles: 1,
                        acceptedFiles: "image/*",
                        addRemoveLinks: true,
                        timeout: 180000,
                        dictDefaultMessage: "click to upload your main picture...",
                        url: "{{ route('frontend.post.images.upload') }}",
                        init: function() {
                            this.on("success", function(file, response) {
                                file.serverId = response;
                                $('#myimagedropzone').append('<input type="hidden" id="image_'+response+'" name="main_image" value="'+response+'" />');
                            });
                            this.on("removedfile", function(file) {
                                if (!file.serverId) {
                                    var _ref;
                                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                                }

                                // data
                                var data = { 'id': file.serverId, 'post_id': post_id }

                                // delete request
                                $.ajax({
                                    url: '{{ route('frontend.post.images.upload') }}',
                                    data: data,
                                    type: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (result) {
                                        $("#image_" + file.serverId).remove();
                                        // var _ref;
                                        // return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                                    }
                                });
                            });
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                })

                $(document).ready(function () {
                    var myvideodropzone = $("#myvideodropzone").dropzone({
                        maxFiles: 1,
                        acceptedFiles: "video/*",
                        addRemoveLinks:true,
                        timeout: 180000,
                        dictDefaultMessage: "click to upload your advert video...",
                        url: "{{ route('frontend.post.video.upload') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (file, response) {
                            // console.log(response);
                        },
                        init: function() {
                            this.on("addedfile", function(file, done) {
                                var previewEl = $("video#preview");
                                if (previewEl[0].canPlayType(file.type) !== "no"){
                                    var fileURL = URL.createObjectURL(file);

                                    $(previewEl).one('loadeddata', function(){
                                        URL.revokeObjectURL(fileURL);
                                    });
                                    previewEl[0].src = fileURL;
                                }
                            })

                            this.on("success", function(file, response) {
                                file.serverId = response;
                                $('#myvideodropzone').append('<input type="hidden" id="video_'+response+'" name="main_video" value="'+response+'" />');
                            });

                            this.on("removedfile", function(file) {
                                if (!file.serverId) {
                                    // var _ref;
                                    // return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                                }

                                // data
                                var data = { 'id': file.serverId, 'post_id': post_id }

                                // delete request
                                $.ajax({
                                    url: '{{ route('frontend.post.video.upload') }}',
                                    data: data,
                                    type: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (result) {
                                        $("#video_" + file.serverId).remove();
                                        var previewEl = $("video#preview");
                                        previewEl[0].src = '';
                                    }
                                });
                            });
                        }
                    });
                })
            </script>

            <!-- Summer notes settings -->
            <script>
                $(document).ready(function() {
                    $('#summernote').summernote({
                        height: 250,
                        toolbar: [
                            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                            [ 'fontname', [ 'fontname' ] ],
                            [ 'fontsize', [ 'fontsize' ] ],
                            [ 'color', [ 'color' ] ],
                            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                            [ 'table', [ 'table' ] ],
                            [ 'insert', [ 'link'] ],
                            [ 'view', [ 'undo', 'redo' ] ]
                        ]
                    });
                });
            </script>

            <!-- Wizard JS-->
            <script>
                (function($) {

                    var createPostForm = $("#create-post-form");

                    createPostForm.children("div").steps({
                        headerTag: "h3",
                        bodyTag: "section",
                        transitionEffect: "slideLeft",
                        onStepChanging: function(event, currentIndex, newIndex) {

                            if(newIndex < currentIndex) {
                                return true;
                            }

                            // Validate and submit step 1 form
                            if(currentIndex == 0){
                                var is_valid = true;
                                var stepOneFormData = {};

                                $('#steps-uid-0-p-' + currentIndex + ' input, #steps-uid-0-p-' + currentIndex + ' select').filter( ".is_required" ).not(".ignore").each(
                                    function(index){
                                        var input = $(this);
                                        if(input.val() == ''){
                                            is_valid = false
                                            input.addClass('is-invalid')
                                        }else{
                                            stepOneFormData[input.attr('name')] = input.val();
                                            input.removeClass('is-invalid')
                                        }
                                    }
                                );

                                $('#steps-uid-0-p-' + currentIndex + ' input, #steps-uid-0-p-' + currentIndex + ' select').not(".is_required").each(
                                    function(index){
                                        var input = $(this);
                                        stepOneFormData[input.attr('name')] = input.val();
                                    }
                                );

                                // if form is valid, make ajax call
                                if(is_valid){
                                    // make ajax call
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('frontend.api.create.advert.step.one') }}",
                                        data: {...stepOneFormData, ...{post_id: post_id}},
                                        async: false,
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        beforeSend: function(){
                                            // $('.submitBtn').attr("disabled","disabled");
                                            $('#create-post-form').css("opacity",".5");
                                            $('.loader-container-inner').css('visibility', 'visible');
                                            $('input, select').removeClass('is-invalid');
                                        },
                                        success: function(response){
                                            // $(".submitBtn").removeAttr("disabled");
                                            if(response.success){
                                                $('#create-post-form').css("opacity","");
                                                $('.loader-container-inner').css('visibility', 'hidden');
                                                step_one_completed = true;
                                                post_id = response.data.id;
                                                $('#post_id').val(post_id);
                                            }else{
                                                step_one_completed = false
                                            }
                                        },
                                        error: function(xhr) { // if error occured
                                            swal("Something went wrong!", "Kindly review your inputs!", "error");
                                            $('#create-post-form').css("opacity","");
                                            $('.loader-container-inner').css('visibility', 'hidden');
                                            $(".submitBtn").removeAttr("disabled");

                                            $.each(xhr.responseJSON.errors, function(key,value) {
                                                $('[name="'+key+'"]').addClass('is-invalid');
                                            });
                                        }
                                    });
                                }
                                return step_one_completed;
                            }

                            // validate form 2
                            if(currentIndex == 1){
                                var is_valid = true;
                                var stepTwoFormData = {};

                                $('#steps-uid-0-p-' + currentIndex + ' input, #steps-uid-0-p-' + currentIndex + ' select' + ' , #steps-uid-0-p-' + currentIndex + ' textarea').filter( ".is_required" ).not(".ignore").each(
                                    function(index){
                                        var input = $(this);
                                        // console.log(input)
                                        if(input.val() == ''){
                                            is_valid = false
                                            input.addClass('is-invalid')
                                        }else{
                                            stepTwoFormData[input.attr('name')] = input.val();
                                            input.removeClass('is-invalid')
                                        }
                                    }
                                );

                                $('#steps-uid-0-p-' + currentIndex + ' input, #steps-uid-0-p-' + currentIndex + ' select' + ' , #steps-uid-0-p-' + currentIndex + ' textarea').not( ".is_required" ).each(
                                    function(index){
                                        var input = $(this);
                                        stepTwoFormData[input.attr('name')] = input.val();
                                    }
                                );

                                // if form is valid, make ajax call
                                if(is_valid){
                                    // make ajax call
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('frontend.api.create.advert.step.two') }}",
                                        data: {...stepTwoFormData, ...{post_id: post_id}},
                                        async: false,
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        beforeSend: function(){
                                            // $('.submitBtn').attr("disabled","disabled");
                                            $('#create-post-form').css("opacity",".5");
                                            $('input, select').removeClass('is-invalid');
                                        },
                                        success: function(response){
                                            // $(".submitBtn").removeAttr("disabled");
                                            if(response.success){
                                                $('#create-post-form').css("opacity","");
                                                step_two_completed = true;
                                                post_id = response.data.id;
                                            }else{
                                                step_two_completed = false
                                            }
                                        },
                                        error: function(xhr) { // if error occured
                                            swal("Something went wrong!", "Kindly review your inputs!", "error");
                                            $('#create-post-form').css("opacity","");
                                            $(".submitBtn").removeAttr("disabled");

                                            $.each(xhr.responseJSON.errors, function(key,value) {
                                                $('[name="'+key+'"]').addClass('is-invalid');
                                            });
                                        }
                                    });
                                }
                                return step_two_completed;
                            }

                            // validate form 3
                            if(currentIndex == 2){
                                var is_valid = true;
                                var stepThreeFormData = [];
                                var other_images = [];
                                var main_image = null;
                                var main_video = null;

                                var dzoneVideo = document.querySelector("#myvideodropzone").dropzone;
                                var dzoneImages = document.querySelector("#myimagedropzone").dropzone;
                                var dzoneMainImage = document.querySelector("#mainimagedropzone").dropzone;
                                if(dzoneVideo.getUploadingFiles().length  > 0 || dzoneImages.getUploadingFiles().length > 0 || dzoneMainImage.getUploadingFiles().length > 0){
                                    swal("Some files are still uploading", "", "info");
                                    return false;
                                }

                                $('#steps-uid-0-p-' + currentIndex + ' input').each(
                                    function(index){
                                        var input = $(this);
                                        // console.log(input)
                                        if(input.val() == ''){
                                            is_valid = false
                                            input.addClass('is-invalid')
                                        }else{
                                            if(input.attr('name') == 'main_image'){
                                                main_image = input.val();
                                            }else if(input.attr('name') == 'main_video'){
                                                main_video = input.val();
                                            }else{
                                                other_images.push(input.val());
                                            }
                                            input.removeClass('is-invalid')
                                        }
                                    }
                                );

                                // console.log(stepThreeFormData);

                                // if form is valid, make ajax call
                                if(is_valid){
                                    // make ajax call
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('frontend.api.create.advert.step.three') }}",
                                        data: { images:other_images, post_id: post_id, main_image:main_image, main_video:main_video },
                                        async: false,
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        beforeSend: function(){
                                            // $('.submitBtn').attr("disabled","disabled");
                                            $('#create-post-form').css("opacity",".5");
                                            $('input, select').removeClass('is-invalid');
                                        },
                                        success: function(response){
                                            // $(".submitBtn").removeAttr("disabled");
                                            if(response.success){
                                                $('#create-post-form').css("opacity","");
                                                step_three_completed = true;
                                                post_id = response.data.id;
                                            }else{
                                                step_three_completed = false
                                            }
                                        },
                                        error: function(xhr) { // if error occured
                                            swal("Please upload images!", "", "error");
                                            $('#create-post-form').css("opacity","");
                                            $(".submitBtn").removeAttr("disabled");

                                            $.each(xhr.responseJSON.errors, function(key,value) {
                                                // console.log(key)
                                                $('[name="'+key+'"]').addClass('is-invalid');
                                            });
                                            step_three_completed = false
                                        }
                                    });
                                }
                                return step_three_completed;
                            }
                        },
                        onFinished: function(event, currentIndex) {
                            submitStepForm()
                        }
                    });
                })(jQuery);

                function submitStepForm() {
                    swal({
                        title:'Your post is about to be published',
                        // icon: 'warning',
                        showCancelButton: true,
                        // confirmButtonColor: '#3f51b5',
                        // cancelButtonColor: '#ff4081',
                        // confirmButtonText: 'Great',
                        buttons: {
                            cancel: {
                                text: 'Cancel',
                                value: null,
                                visible: true,
                                className: 'btn btn-danger',
                                closeModal: true,
                            },
                            confirm: {
                                text: 'Proceed',
                                value: true,
                                visible: true,
                                className: 'btn btn-primary',
                                closeModal: true
                            }
                        }
                    }).then((willDelete) => {
                        if (willDelete) {
                            // click payment button
                            @if (isset(Auth::user()->userPlan) && Auth::user()->userPlan && Auth::user()->userPlan->ad_limit > 0 )
                            $('#create-post-form').css("opacity",".5");
                            $('.loader-container-inner').css('visibility', 'visible');
                            $('#create-post-form').submit();
                            @else
                            if(selectedSubscriptionPlan == 0){
                                $('#create-post-form').css("opacity",".5");
                                $('.loader-container-inner').css('visibility', 'visible');
                                $('#create-post-form').submit();
                            }else{
                                document.getElementsByClassName("stripe-button-el")[0].click();
                            }
                            @endif
                        }
                    });
                }

                function selectSubscriptionPlan(plan_id, display_price) {
                    selectedSubscriptionPlan = display_price;
                    $('[name="plan_id"]').val(plan_id);
                    $("[id^=subscription-button-]").removeClass('btn-primary')
                    $("[id^=subscription-button-]").addClass('btn-outline-primary')
                    $('#subscription-button-' + plan_id).removeClass('btn-outline-primary')
                    $('#subscription-button-' + plan_id).addClass('btn-primary')
                    StripeCheckout.__app.configurations.button0.amount = parseFloat(display_price) * 100;
                    // $('#stripe-button').attr("data-amount", parseFloat(display_price) * 100); //setter
                    submitStepForm()
                }
            </script>
            <!-- End custom js for this page-->

            {{-- Form Data Autofill --}}
            <script>
                $(document).ready(function(){

                    // change screens by categories
                    $("#category_id").change(function(){
                        var selectedCategory = $(this).children("option:selected").text();

                        if (selectedCategory === "Vehicles" || selectedCategory === "Car") {
                            $('#classificationSelectTitle').text('Vehicle Body Type');
                            $('#makeSelectTitle').text('Vehicle Make');
                            $('#modelInputTitle').text('Vehicle Model');

                            $('.only-cars').show();
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
                        if (selectedCategory === "Bikes") {
                            $('#classificationSelectTitle').text('Bike Body Type');
                            $('#makeSelectTitle').text('Bike Make');
                            $('#modelInputTitle').text('Select / Enter Model');

                            $('.only-bikes').show();
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
                        if (selectedCategory === "Parts") {
                            $('#classificationSelectTitle').text('Make');
                            $('#makeSelectTitle').text('Model');
                            $('#modelInputTitle').text('Select / Enter Part');

                            $('.only-parts').show();
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
                        if (selectedCategory.includes("General")) {
                            $('#classificationSelectTitle').text('Category');
                            $('#makeSelectTitle').text('Sub Category');
                            $('#modelInputTitle').text('Select / Enter Item name');

                            $('.only-general').show();
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
                    });
                });
            </script>
            {{-- End Form Data Autofill --}}

            {{-- Select2 --}}
            <script>
                $(document).ready(function() {

                    var url = '{{ route("frontend.api.states.search") }}'
                    // make ajax call
                    $.get(url,function (res, status) {
                        $('select[name="state_id"]').select2({data: res.results,theme: "bootstrap"});
                        $('select[name="state_id"]').trigger("change");
                    });


                    $('select[name="state_id"]').change(function() {
                        var state_id = $('select[name="state_id"]').val();
                        var url = '{{ route("frontend.api.cities.search",":id") }}'
                        url = url.replace(':id', state_id);
                        // empty select
                        $('select[name="city_id"]').empty();
                        $.get(url,function (res, status) {
                            $('select[name="city_id"]').select2({data: res.results,theme: "bootstrap"});
                        });
                    });

                    $('select[name="category_id"]').change(function() {
                        var category_id = $('select[name="category_id"]').val();
                        var url = '{{ route("frontend.api.types.search",":id") }}'
                        url = url.replace(':id', category_id);
                        $('select[name="type_id"]').empty();
                        $('select[name="make_id"]').empty();
                        $('#type_list').empty();
                        $('#model_id').val('');

                        // make ajax call
                        $.get(url,function (res, status) {
                            $('select[name="type_id"]').select2({data: res.results,theme: "bootstrap"});
                            $('select[name="type_id"]').trigger("change");
                        });
                    });

                    $('select[name="type_id"]').change(function() {
                        var category_id = $('select[name="category_id"]').val();
                        var make_id = $('select[name="type_id"]').val();

                        var url = "{{ route('frontend.api.makes.search') }}" + '/' + make_id + '/' + category_id;

                        $('select[name="make_id"]').empty();

                        // make ajax call
                        $.get(url,function (res, status) {
                            $('select[name="make_id"]').select2({data: res.results,theme: "bootstrap"});
                            $('select[name="make_id"]').trigger("change");
                        });
                    });

                    $('select[name="make_id"]').change(function() {
                        var make_id = $('select[name="make_id"]').val();
                        var type_id = $('select[name="type_id"]').val();
                        var category_id = $('select[name="category_id"]').val();

                        var url = '{{ route("frontend.api.models.search",":id") }}'
                        url = url.replace(':id',  "make_id="+make_id+"&type_id="+type_id+"&category_id="+category_id);
                        $('#model_id').val('');
                        $('#type_list').empty();
                        // make ajax call
                        $.get(url,function (res, status) {
                            $.each(res.results, function(i, item) {
                                $("#type_list").append($("<option>").attr('value', item.text));
                            });
                        });
                    });

                });
            </script>
            {{-- End Select2 --}}

            {{-- Subscription button --}}
            <script>
                $("#category_id").change(function(){
                    $('data-entry form col-sm-3').slice(1).remove();
                })
            </script>

@endsection
