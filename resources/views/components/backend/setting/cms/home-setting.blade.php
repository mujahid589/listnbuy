<form class="form-horizontal" action="{{ route('admin.home.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index1_main_banner') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index1_main_banner_path }}" name="index1_main_banner"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index1_counter_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index1_counter_background_path }}" name="index1_counter_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index1_mobile_app_banner') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index1_mobile_app_banner_path }}" name="index1_mobile_app_banner"
                        autocomplete="image">
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index2_search_filter_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index2_search_filter_background_path }}" name="index2_search_filter_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index2_get_membership_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index2_get_membership_background_path }}" name="index2_get_membership_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index3_search_filter_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index3_search_filter_background_path }}" name="index3_search_filter_background"
                        autocomplete="image">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Vehicle Header </label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                           data-default-file="{{ $cms->vehicles_header_path }}" name="vehicles_header"
                           autocomplete="image">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Motor Bike Header </label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                           data-default-file="{{ $cms->motorbikes_header_path }}" name="motorbikes_header"
                           autocomplete="image">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Auto Part Header </label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                           data-default-file="{{ $cms->auto_parts_header_path }}" name="auto_parts_header"
                           autocomplete="image">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>General Market Header </label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                           data-default-file="{{ $cms->general_market_header_path }}" name="general_header"
                           autocomplete="image">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Handy Man Header </label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                           data-default-file="{{ $cms->handy_man_header_path }}" name="handy_man_header"
                           autocomplete="image">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Junk Cars Header </label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                           data-default-file="{{ $cms->junk_cars_header_path }}" name="junk_cars_header"
                           autocomplete="image">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Local Rent Header </label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                           data-default-file="{{ $cms->local_rent_header_path }}" name="local_rent_header"
                           autocomplete="image">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Coming Soon Header </label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                           data-default-file="{{ $cms->coming_soon_header_path }}" name="coming_soon_header"
                           autocomplete="image">
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-8 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('upate_home_settings') }}
            </button>
        </div>
    </div>
</form>

