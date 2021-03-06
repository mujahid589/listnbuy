<li class="nav-item dashboard-post__item" role="presentation">
    <div class="nav-link dashboard-post__link
        @if (session('step3'))
            active
        @endif
    " >
        <span class="icon icon--default">
            <x-svg.rocket-icon />
        </span>
        <span class="icon icon--success">
            <x-svg.check-icon width="24" height="24" stroke="currentColor" />
        </span>
        <div class="step-info">
            <h2 class="text--body-3-600">{{ __('website.steps03') }}</h2>
            <p class="text--body-4">Review</p>
        </div>
    </div>
</li>
