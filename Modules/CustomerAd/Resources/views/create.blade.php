@extends('layouts.backend.postads')

@section('title')
    {{ __('create_ad') }}
@endsection

@section('post-ad-content')


            <div class="col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('create_ad') }}</h3>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-12 px-5">
                            <form class="form-horizontal" action="{{ route('frontend.post.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">{{ __('title') }} <span class="text-danger">*</span></label>
                                                <input required type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter ad title" >
                                                @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('price') }} <span class="text-danger">*</span></label>
                                                <input required type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Enter ad price" >
                                                @error('price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                {{--                                            <label>{{ __('upload_thumbnail') }} <span class="text-danger">*</span></label>--}}
                                                {{--                                            <input required name="thumbnail" type="file"--}}
                                                {{--                                                accept="image/png, image/jpg, image/jpeg"--}}
                                                {{--                                                class="form-control dropify @error('thumbnail') is-invalid @enderror"--}}
                                                {{--                                                style="border:none;padding-left:0;"--}}
                                                {{--                                                data-max-file-size="3M"--}}
                                                {{--                                                data-show-errors="true"--}}
                                                {{--                                                data-allowed-file-extensions="jpg png jpeg" />--}}
                                                {{--                                            @error('thumbnail') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror--}}

                                                <div class="upload-wrapper">
                                                    <h3>Upload Photos<span class="text-danger">*</span></h3>
                                                    <div class="upload-area @error('images') border-danger @enderror">
                                                        <div class="uploaded-items"></div>
                                                        <div class="add-new">
                                                            <x-svg.image-select-icon />
                                                            <input name="images[]" multiple type="file" hidden id="addNew" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>{{ __('select_category') }} <span class="text-danger">*</span></label>
                                                <select required name="category_id" id="ad_category" class="form-control @error('category_id') border-danger @enderror">
                                                    @foreach ($categories as $category)
                                                        <option {{ old('category_id') == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>{{ __('select_subcategory') }} <span class="text-danger">*</span></label>
                                                <select required name="subcategory_id" id="ad_subcategory" class="form-control @error('subcategory_id') border-danger @enderror"></select>
                                                @error('subcategory_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('brand') }} <span class="text-danger">*</span></label>
                                                <select required name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                                    @foreach ($brands as $brand)
                                                        <option {{ old('brand_id') == $brand->id ? 'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('brand_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('model') }} <span class="text-danger">*</span></label>
                                                <input required type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}" placeholder="Enter ad model" >
                                                @error('model') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>{{ __('city') }} <span class="text-danger">*</span></label>
                                                <select required name="city_id" id="ad_city" class="form-control @error('city_id') border-danger @enderror">
                                                    @foreach ($cities as $city)
                                                        <option {{ old('city_id') == $city->id ? 'selected':'' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>{{ __('town') }} <span class="text-danger">*</span></label>
                                                <select required name="town_id" id="ad_town" class="form-control @error('town_id') border-danger @enderror"></select>
                                                @error('town_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('authenticity') }} <span class="text-danger">*</span></label>
                                                <select required name="authenticity" class="form-control @error('authenticity') is-invalid @enderror">
                                                    <option {{ old('authenticity') == 'original' ? 'selected':'' }} value="original">{{ __('original') }}</option>
                                                    <option {{ old('authenticity') == 'refurbished' ? 'selected':'' }} value="refurbished">{{ __('refurbished') }}</option>
                                                </select>
                                                @error('authenticity') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('condition') }} <span class="text-danger">*</span></label>
                                                <select required name="condition" class="form-control @error('condition') is-invalid @enderror">
                                                    <option {{ old('condition') == 'new' ? 'selected':'' }} value="new">{{ __('new') }}</option>
                                                    <option {{ old('condition') == 'used' ? 'selected':'' }} value="used">{{ __('used') }}</option>
                                                </select>
                                                @error('condition') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('phone_number') }} <span class="text-danger">*</span></label>
                                                <input required type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Enter customer phone number" >
                                                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('optional_phone_number') }}</label>
                                                <input type="text" name="phone_2" class="form-control @error('phone_2') is-invalid @enderror" value="{{ old('phone_2') }}" placeholder="Enter another phone number" >
                                                @error('phone_2') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <div class="icheck-success d-inline">
                                                    <input {{ old('negotiable') == 1 ? 'checked':'' }} value="1" name="negotiable" type="checkbox" class="form-check-input" id="checkme" />
                                                    <label class="form-check-label mr-5" for="checkme">{{ __('negotiable') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icheck-success d-inline">
                                                    <input {{ old('featured') == 1 ? 'checked':'' }} value="1" name="featured" type="checkbox" class="form-check-input" id="featured" />
                                                    <label class="form-check-label" for="featured">{{ __('featured') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-4">




                                        <div class="col-md-12 mb-3">
                                            <div class="input-field--textarea">
                                                <label for="feature">{{ __('features') }} <span class="text-mute">(optional)</span></label>
                                                <div id="multiple_feature_part">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="input-field mb-3">
                                                                <input required name="features[]" type="text" placeholder="Feature" id="adname" class="form-control @error('features') border-danger @enderror"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 mt-10">
                                                            <a role="button" onclick="add_features_field()"
                                                            class="btn bg-primary btn-sm text-light"><i class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">{{ __('description') }} <span class="text-danger">*</span></label>
                                        <textarea required id="editor2" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('write_description_of_ad') }}">
                                            {{ old('description') }}
                                        </textarea>

                                        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp; {{ __('create') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


    @if(old('subcategory_id'))
        <input type="hidden" id="subct_id" value="{{ old('subcategory_id') }}">
    @else
        <input type="hidden" id="subct_id" value="">
    @endif

    @if(old('town_id'))
        <input type="hidden" id="town_id" value="{{ old('town_id') }}">
    @else
        <input type="hidden" id="town_id" value="">
    @endif

@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>

    {{-- ck-editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
    </script>

    {{-- category-subcategory dropdown --}}
    <script>
        var subct_id = document.getElementById('subct_id').value;

        $(document).ready(function() {
            var category_id = document.getElementById('ad_category').value;
            cat_wise_subcat(category_id);
        });



        // category wise subcategory function
        function cat_wise_subcat(categoryID){
            axios.get('/dashboard/get_subcategory/'+categoryID).then((res => {
                console.log(res);
                if(res.data){
                    $('#ad_subcategory').empty();
                    $.each(res.data, function(key, subcat){

                        var matched = parseInt(subct_id) === subcat.id ? true: false

                        $('select[name="subcategory_id"]').append(
                            `<option ${matched ? 'selected':''} value="${subcat.id}">${subcat.name}</option>`
                        );
                    });
                }else{
                    $('#ad_subcategory').empty();
                }
            }))
        }

        // Category wise subcategories dropdown
        $('#ad_category').on('change', function() {
        var categoryID = $(this).val();
            if(categoryID) {
                cat_wise_subcat(categoryID);
            }
        });
    </script>

    {{-- city-town dropdown --}}
    <script>
        var town_id = document.getElementById('town_id').value;

        $(document).ready(function() {
            var city_id = document.getElementById('ad_city').value;
            city_wise_town(city_id);
        });

        // city wise town function
        function city_wise_town(cityID){
            axios.get('/dashboard/get_town/'+cityID).then((res => {
                console.log(res);
                if(res.data){
                    $('#ad_town').empty();
                    $.each(res.data, function(key, town){

                        var matched = parseInt(town_id) === town.id ? true: false

                        $('select[name="town_id"]').append(
                            `<option ${matched ? 'selected':''} value="${town.id}">${town.name}</option>`
                        );
                    });
                }else{
                    $('#ad_town').empty();
                }
            }))
        }

        // Category wise subcategories dropdown
        $('#ad_city').on('change', function() {
        var cityID = $(this).val();
            if(cityID) {
                city_wise_town(cityID);
            }
        });
    </script>

    {{-- Featured inputs --}}
    <script>
        function add_features_field() {
            $("#multiple_feature_part").append(`
                <div class="row">
                    <div class="col-lg-10">
                            <div class="input-field mb-3">
                                <input name="features[]" type="text" placeholder="Feature" id="adname" class="form-control @error('features') border-danger @enderror"/>
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

    {{-- Dropify image upload --}}
    <script>
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.error.fileSize', function(event, element){
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element){
            alert('Image format error message!');
        });
    </script>

    <script>
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
    <script>
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
    </script>
@endsection
