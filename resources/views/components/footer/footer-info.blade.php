<div class="col-xl-3">
    <div class="footer__brand-logo">
        @if ($logotype === 'dark')
        <img style="
            height: 40px;
            width: 170px;" src="{{ asset($settings->logo_image2) }}" alt="logo-brand" />
        @else
        <img style="
            height: 40px;
            width: 170px;" src="{{ asset($settings->logo_image) }}" alt="logo-brand" />
        @endif
    </div>
    <div class="footer__loc-info">
        
        <P class="text--body-3" 

        style="font-style: normal;font-weight: 400;font-size: 16px;line-height: 23px;text-transform:none;margin-bottom:50px">
            Listnbuy.com was born out of the desire to bring that smooth interaction of a well designed and communicative user's interface that transcends excellence in the transactions between the buyer and the sellers trading on our platform.
        </P>   
        
        <p class="text--body-3" style="text-transform:none">
            {{ $settings->address }}
        </p>
        <p class="text--body-3 phone" style="text-transform:none">
            {{ __('website.phone') }}: {{ $settings->phone }}
        </p>
        <p class="text--body-3 email" style="text-transform:none">
            {{ __('website.mail') }}: {{ $settings->email }}
        </p>
    </div>
</div>
