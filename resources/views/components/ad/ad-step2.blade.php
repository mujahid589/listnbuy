<li class="nav-item dashboard-post__item" role="presentation">
    <div class="nav-link dashboard-post__link
        @if (session('step2'))
            active
        @elseif (session('step2_success'))
            success
        @endif
    ">
        <span class="icon icon--default">
            <x-svg.step-two-icon />
        </span>
        <span class="icon icon--success">
            <x-svg.check-icon width="24" height="24" stroke="currentColor" />
        </span>
        <div class="step-info">
            <h2 class="text--body-3-600">{{ __('website.steps02') }}</h2>
{{--            <p class="text--body-4">{{ __('website.contact_info') }}</p>--}}
            <p class="text--body-4">Upload Images and Video </p>
        </div>
    </div>
</li>
