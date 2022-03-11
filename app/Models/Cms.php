<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cms extends Model
{
    use HasFactory;

    protected $table ='cms';



    protected $fillable = [
        'index1_main_banner', 'index1_counter_background', 'index1_mobile_app_banner', 'index2_search_filter_background',
        'index2_get_membership_background', 'index3_search_filter_background',
        'terms_background', 'terms_body', 'about_video_thumb', 'about_body', 'privacy_background',
        'privacy_body', 'contact_background', 'get_membership_background', 'get_membership_image',
        'pricing_plan_background', 'faq_background', 'dashboard_overview_background',
        'dashboard_post_ads_background', 'dashboard_my_ads_background', 'dashboard_plan_background',
        'dashboard_account_setting_background', 'posting_rules_background', 'posting_rules_body',
        'about_background', 'dashboard_favorite_ads_background', 'dashboard_messenger_background',
        'blog_background', 'ads_background','vehicles_header','motorbikes_header','auto_parts_header',
        'general_header','handy_man_header','junk_cars_header','local_rent_header','coming_soon_header'
    ];







    public function getIndex1MainBannerPathAttribute()
    {

        //return file_exists($this->index1_main_banner) ? asset($this->index1_main_banner) : asset('frontend/default_images/bg/listnbuyheadercar.jpg');

        return $this->index1_main_banner ? asset($this->index1_main_banner) : asset('frontend/default_images/bg/listnbuyheadercar.jpg');
      // return file_exists($this->index1_main_banner) ? asset($this->index1_main_banner) : asset('frontend/default_images/index1_main_banner.png');

       // return asset($this->index1_main_banner);
    }


    public function getIndex1CounterBackgroundPathAttribute()
    {
       return $this->index1_counter_background ? asset($this->index1_counter_background) : asset('frontend/default_images/index1_counter_background.png');

    }


    public function getIndex1MobileAppBannerPathAttribute()
    {
      // return file_exists($this->index1_mobile_app_banner) ? asset($this->index1_mobile_app_banner) : asset('frontend/default_images/index1_mobile_app_banner.png');
        return $this->index1_mobile_app_banner ? asset($this->index1_mobile_app_banner) : asset('frontend/default_images/index1_mobile_app_banner.png');

    }


    public function getIndex2SearchFilterBackgroundPathAttribute()
    {
       return $this->index2_search_filter_background ? asset($this->index2_search_filter_background) : asset('frontend/default_images/index2_search_filter_background.png');
    }


    public function getIndex2GetMembershipBackgroundPathAttribute()
    {
       return $this->index2_get_membership_background ? asset($this->index2_get_membership_background) : asset('frontend/default_images/index2_get_membership_background.png');
    }


    public function getIndex3SearchFilterBackgroundPathAttribute()
    {
       return $this->index3_search_filter_background ? asset($this->index3_search_filter_background) : asset('frontend/default_images/index3_search_filter_background.png');
    }


    public function getTermsBackgroundPathAttribute()
    {
       return $this->terms_background ? asset($this->terms_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getPrivacyBackgroundPathAttribute()
    {
       return $this->privacy_background ? asset($this->privacy_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getAboutVideoThumbPathAttribute()
    {
        return $this->about_video_thumb ? asset($this->about_video_thumb) : asset('frontend/default_images/about_video_thumb.png');
        //return asset('frontend/default_images/about_video_thumb.png');

        //return asset($this->about_video_thumb);
    }


    public function getAboutBackgroundPathAttribute()
    {
        return $this->about_background ? asset($this->about_background) : asset('frontend/default_images/default_background.png');
       // return asset($this->about_background);
    }


    public function getPricingPlanBackgroundPathAttribute()
    {
       return $this->pricing_plan_background ? asset($this->pricing_plan_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getFaqBackgroundPathAttribute()
    {
       return $this->faq_background ? asset($this->faq_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardOverviewBackgroundPathAttribute()
    {
       return $this->dashboard_overview_background ? asset($this->dashboard_overview_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardPostAdsBackgroundPathAttribute()
    {
       return $this->dashboard_post_ads_background ? asset($this->dashboard_post_ads_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardMyAdsBackgroundPathAttribute()
    {
       return $this->dashboard_my_ads_background ? asset($this->dashboard_my_ads_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardPlanBackgroundPathAttribute()
    {
       return $this->dashboard_plan_background ? asset($this->dashboard_plan_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardAccountSettingBackgroundPathAttribute()
    {
       return $this->dashboard_account_setting_background ? asset($this->dashboard_account_setting_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getPostingRulesBackgroundPathAttribute()
    {
       return $this->posting_rules_background ? asset($this->posting_rules_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getGetMembershipBackgroundPathAttribute()
    {
       return $this->posting_rules_background ? asset($this->posting_rules_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getDashboardFavoriteAdsBackgroundPathAttribute()
    {
        return $this->dashboard_favorite_ads_background ? asset($this->dashboard_favorite_ads_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardMessengerBackgroundPathAttribute()
    {
        return $this->dashboard_messenger_background ? asset($this->dashboard_messenger_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getBlogBackgroundPathAttribute()
    {
       return $this->blog_background ? asset($this->blog_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getAdsBackgroundPathAttribute()
    {
       return $this->ads_background ? asset($this->ads_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getContactBackgroundPathAttribute()
    {
       return $this->contact_background ? asset($this->contact_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getDefaultBackgroundPathAttribute()
    {
       return asset('frontend/default_images/default_background.jpg');
    }

    public function getVehiclesHeaderPathAttribute()
    {
        return $this->vehicles_header ? asset($this->vehicles_header) : asset('frontend/default_images/default_background.jpg');
    }

    public function getMotorbikesHeaderPathAttribute()
    {
        return $this->motorbikes_header ? asset($this->motorbikes_header) : asset('frontend/default_images/default_background.jpg');
    }

    public function getAutoPartsHeaderPathAttribute()
    {
        return $this->auto_parts_header ? asset($this->auto_parts_header) : asset('frontend/default_images/default_background.jpg');
    }


    public function getGeneralMarketHeaderPathAttribute()
    {
        return $this->general_header ? asset($this->general_header) : asset('frontend/default_images/default_background.jpg');
    }


    public function getHandyManHeaderPathAttribute()
    {
        return $this->handy_man_header ? asset($this->handy_man_header) : asset('frontend/default_images/default_background.jpg');
    }


    public function getJunkCarsHeaderPathAttribute()
    {
        return $this->junk_cars_header ? asset($this->junk_cars_header) : asset('frontend/default_images/default_background.jpg');
    }


    public function getLocalRentHeaderPathAttribute()
    {
        return $this->local_rent_header ? asset($this->local_rent_header) : asset('frontend/default_images/default_background.jpg');
    }


    public function getComingSoonHeaderPathAttribute()
    {
        return $this->coming_soon_header ? asset($this->coming_soon_header) : asset('frontend/default_images/default_background.jpg');
    }




}
