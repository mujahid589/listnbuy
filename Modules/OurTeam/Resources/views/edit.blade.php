@extends('layouts.backend.admin')
@section('title') {{ __('edit_testimonial') }} @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">Edit Team Member</h3>
                        <a href="{{ route('module.ourteam.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-3">
                        <div class="col-6 offset-3">
                            <div class="text-center">
                                @if ($ourteam->image)
                                    <img class="rounded" id="image" width="150px" height="150px"
                                        src=" {{ asset($ourteam->image) }}" alt="user image"
                                        style="border: 1px solid #adb5bd;margin: 0 auto;padding: 3px;">
                                @else
                                    <img class="rounded" width="150px" height="150px" id="image"
                                        src="{{ asset('backend/image/default.png') }}" alt="User profile picture"
                                        style="border: 1px solid #adb5bd;margin: 0 auto;padding: 3px;">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-8 offset-md-2">
                            <form class="form-horizontal"
                                action="{{ route('module.ourteam.update', $ourteam->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('name') }}<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input value="{{ $ourteam->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('enter_name') }}">
                                        @error('name') <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('position') }}<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input value="{{ $ourteam->position }}" name="position" type="text"
                                            class="form-control @error('position') is-invalid @enderror"
                                            placeholder="{{ __('enter_position') }}">
                                        @error('position') <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
<<<<<<< HEAD

                                    <label class="col-sm-3 col-form-label">Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select required value="{{ $ourteam->type }}"  name="type" id="ad_category" class="form-control @error('type') border-danger @enderror">

                                            <option {{ $ourteam->type  == 'director' ? 'selected':'' }} value="director">Director</option>
                                            <option {{ $ourteam->type  == 'staff' ? 'selected':'' }} value="staff">Staff</option>

                                        </select>
                                    </div>

                                    @error('type') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-3 col-form-label">Order <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select   value="{{ $ourteam->order }}" required name="order" id="ad_category" class="form-control @error('order') border-danger @enderror">
                                            @for ($i=0;$i<20;$i++)
                                                <option {{ $ourteam->order == $i ? 'selected':'' }} value="{{ $i }}">{{ $i }}</option>
                                            @endfor


                                        </select>
                                    </div>

                                    @error('type') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                </div>
                                <div class="form-group row">
=======
>>>>>>> 22b55fde6224d191d258811364a6227ea57cd3df
                                    <label class="col-sm-3 col-form-label">{{ __('image') }}</label>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input name="image" autocomplete="image"
                                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                                id="customFile">
                                            <label class="custom-file-label" for="customFile">{{ __('choose_file') }}</label>
                                            @error('image') <span class="text-danger invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('description') }}<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <textarea id="decribe_ck" rows="8" type="text" class="form-control" name="description"
                                            placeholder="{{ __('write_description_of_testimonial') }}... ">{{ $ourteam->description }}</textarea>
                                        @error('description') <span class="text-danger"
                                            style="font-size: 13px;"><strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery.rateyo.min.css') }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 170px;
        }

    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script>
        $('.dropify').dropify();
        ClassicEditor
            .create(document.querySelector('#decribe_ck'))
            .catch(error => {
                console.error(error);
            });


    </script>
@endsection