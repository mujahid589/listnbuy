<style type="text/css">
    button.search-btn {
        font-size: 16px;
        font-weight: 700;
        text-transform: capitalize;
        font-family: "Nunito Sans", sans-serif;
        color: #fff;
        padding: 5px;
        border-radius: 4px;
        background-color: #2a84f2;
    }
</style>

<!-- header section start  -->
<header class="header header--four">
    <div class="container navigation-bar">
        <!-- Brand Logo -->
        <a href="{{ route('frontend.index') }}" class="navigation-bar__logo">
            <img src="{{ asset($settings->logo_image) }}" alt="brand-logo" class="logo-dark" />
        </a>
        <!-- Menu -->
        <ul class="menu">
            <li class="menu__item">
                <a href="{{ route('frontend.index') }}"
                    class="menu__link {{ request()->routeIs('frontend.index') ? 'active' : '' }}">Home</a>
            </li>
            <li class="menu__item">
                <a href="{{ route('frontend.adlist') }}"
                    class="menu__link {{ request()->routeIs('frontend.adlist') ? 'active' : '' }}">Ads</a>
            </li>
            @if ($blog_enable)
                <li class="menu__item">
                    <a href="{{ route('frontend.blog') }}"
                        class="menu__link {{ request()->routeIs('frontend.blog') ? 'active' : '' }}">Blog</a>
                </li>
            @endif
            @if ($priceplan_enable)
                <li class="menu__item">
                    <a href="{{ route('frontend.priceplan') }}"
                        class="menu__link {{ request()->routeIs('frontend.priceplan') ? 'active' : '' }}">Pricing</a>
                </li>
            @endif
            <li class="menu__item">
                <a href="{{ route('frontend.ourteam') }}"
                   class="menu__link {{ request()->routeIs('frontend.ourteam') ? 'active' : '' }}">Our Team</a>
            </li>
            <li class="menu__item">
                <form action="/search" class="search-bar" method="get">
                    <input type="search" name="keyword" pattern=".*\S.*" value="<?= (isset($_GET['keyword']) && !empty($_GET['keyword']))?$_GET['keyword']:''; ?>" placeholder="Search" required style="padding: 6px;">
                    <button class="search-btn" type="submit">
                        <span>Search</span>
                    </button>
                </form>
            </li>
        </ul>
        <!-- Action Buttons -->
        <div class="navigation-bar__buttons">
            @if (auth('customer')->check())
            <a href="{{ route('frontend.dashboard') }}" class="user">
                <div class="user__img-wrapper">
                    @if (auth('customer')->user()->image)
                    <img src="{{ asset(auth('customer')->user()->image) }}"
                        style="width: 40px; height: 40px; border-radius: 50%" alt="User Image">
                    @else
                    <img src="{{ asset('backend/image/default.png') }}"
                        style="width: 40px; height: 40px; border-radius: 50%" alt="User Image">
                    @endif
                </div>
            </a>
            <a href="{{ route('frontend.post') }}" class="btn">
                <span class="icon--left">
                    <x-svg.image-select-icon />
                </span>
                {{ __('website.post_ads') }}
            </a>
            @else
            <div class="btn">
                <span class="icon--left">
                    <x-svg.user-login-icon />
                </span>
                <a class="text-dark" href="{{ route('customer.login') }}">
                    {{ __('website.login') }}
                </a>  /
                <a class="text-dark" href="{{ route('frontend.signup') }}">
                    {{ __('website.register') }}
                </a>
            </div>

            <a href="{{ route('customer.login') }}" onclick="return confirm('You need to login to post ad. Do you want to login?')" class="btn">
                <span class="icon--left">
                    <x-svg.image-select-icon />
                </span>
                {{ __('website.post_ads') }}
            </a>
            @endif
        </div>

        <!-- Responsive Navigation Menu -->
        <button class="toggle-icon">
            <span class="toggle-icon__bar"></span>
            <span class="toggle-icon__bar"></span>
            <span class="toggle-icon__bar"></span>
        </button>
        <ul class="menu--sm">
            <li class="menu--sm__item">
                <a href="{{ route('frontend.index') }}" class="menu--sm__link">Home</a>
            </li>
            <li class="menu--sm__item">
                <a href="{{ route('frontend.adlist') }}" class="menu--sm__link">Ads</a>
            </li>
            @if ($blog_enable)
                <li class="menu--sm__item">
                    <a href="{{ route('frontend.blog') }}" class="menu--sm__link">Blog</a>
                </li>
            @endif
            @if ($priceplan_enable)
                <li class="menu--sm__item">
                    <a href="{{ route('frontend.priceplan') }}" class="menu--sm__link">Pricing</a>
                </li>
            @endif
        </ul>
    </div>
</header>
<!-- header section end  -->
