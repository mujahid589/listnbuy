<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\Cms;
use App\Models\Customer;
use App\Models\PaymentSetting;
use App\Models\Theme;
use App\Notifications\LogoutNotification;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdResource;
use Modules\Blog\Entities\Post;
use Modules\Brand\Repositories\BrandRepositories;
use Modules\Category\Entities\Category;
use Modules\Category\Transformers\CategoryResource;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Entities\FaqCategory;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Modules\OurTeam\Entities\OurTeam;
use Modules\Plan\Entities\Plan;
use Modules\Tag\Entities\Tag;
use Modules\Testimonial\Entities\Testimonial;
use Response;
class FrontEndApiController extends Controller
{

    use ValidatesRequests;

    protected $brand;
    public function __construct(BrandRepositories $brand)
    {
        $this->brand = $brand;
    }
    /**
     * Return Categories
     * @return \Illuminate\Http\Response
     * @return categories
     */

    public function getCategories(){

        try{
            $data = [];
            $topCategories = CategoryResource::collection(Category::with('subcategories')->withCount('ads as ad_count')->latest('ad_count')->take(8)->get());
            $data['topCategories'] = collectionToResource($topCategories);


            return Response::json([
                'data'=>$data
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    public function getBrands(){
        try{
            $data = [];
            $brands = $this->brand->allWithoutPagination();
            $data['brands'] = $brands ;

            return Response::json([
                'data'=>$data
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    public function getTowns(){


        try{
            $data = [];
              $data['towns'] = Town::with('city')->get();

            return Response::json([
                'data'=>$data
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);
//            return Response::json([
//                'data'=>$e
//            ],400);
        }
    }

    public function getCities(){


        try{
            $data = [];
            $data['cities'] = City::latest()->get();
            return Response::json([
                'data'=>$data
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);
//            return Response::json([
//                'data'=>$e
//            ],400);
        }
    }

    public function gateway(){
        $data = [];
        $topCategories = CategoryResource::collection(Category::with('subcategories')->withCount('ads as ad_count')->latest('ad_count')->take(8)->get());
        $home_page = Theme::first()->home_page;
        $data['topCategories'] = collectionToResource($topCategories);

        //session(['lsitingcategory' => 'value']);

        return view('frontend.gateway', $data);
    }

    public function ourteam(){
        $ourteams = OurTeam::latest('id')->get();
        return view('frontend.ourteam', compact('ourteams'));
    }
    /**
     * Return homapge 1 layouts views
     *
     * @param array $data
     *
     * @return View
     */
    public function homePage1($data)
    {
        $ad_data = Ad::with(['customer', 'city', 'category:id,name,icon'])->where('status', '!=', 'expired');
        $ads = AdResource::collection($ad_data->get());
        $categories = CategoryResource::collection(Category::with('subcategories')->get());
        $recommendedAds = AdResource::collection($ad_data->where('featured', true)->take(12)->latest()->get());

        $data['ads'] = collectionToResource($ads);
        $data['categories'] = collectionToResource($categories);
        $data['recommendedAds'] = collectionToResource($recommendedAds);

        $data['verified_users'] = Customer::whereNotNull('email_verified_at')->count();
        $data['city_count'] = City::count();

        $data['pro_members_count'] = Customer::whereHas('userPlan', function ($q) {
            $q->where('badge', true);
        })->count();


        //return $data;

        return view('frontend.index', $data);
    }


    /**
     * Return homepage 2 layouts views
     *
     * @param Array $data
     *
     * @return View
     */
    public function homePage2($data)
    {
        $categories = CategoryResource::collection(Category::withCount('ads as ad_count')->latest()->get());
        $recentads = AdResource::collection(Ad::with('category', 'customer', 'city')->where('status', '!=', 'expired')->latest('id')->get()->take(4));
        $featured_ad_data = Ad::with(['customer', 'city', 'category:id,name,icon',])->where('status', '!=', 'expired')->take(6)->latest()->get();
        $featuredad = AdResource::collection($featured_ad_data);

        $data['categories'] = collectionToResource($categories);
        $data['featuredAds'] = collectionToResource($featuredad);
        $data['recentads'] = $recentads;
        $data['towns'] = Town::orderBy('name')->get();

        return view('frontend.index_02', $data);
    }

    /**
     * Return homepage 3 layouts views
     *
     * @param Array $data
     * @return View
     */
    public function homePage3($data)
    {
        $recentads = AdResource::collection(Ad::with('category', 'city')->where('status', '!=', 'expired')->latest('total_views')->get()->take(8));
        $categories = CategoryResource::collection(Category::latest()->get());
        $plans = Plan::all();
        $ad_data = Ad::with(['category', 'customer', 'city'])->where('status', '!=', 'expired')->take(6)->latest()->get();
        $newestAds = AdResource::collection($ad_data);
        $data['categories']  =  collectionToResource($categories);
        $data['towns']  = Town::orderBy('name')->get();
        $data['recentads']  = collectionToResource($recentads);
        $data['newestAds']  = collectionToResource($newestAds);
        $data['plans']  = $plans;

        return view('frontend.index_03', $data);
    }


    /**
     * View Testimonial page
     *
     * @param  Testimonial
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function about()
    {
        $testimonials = Testimonial::latest('id')->get();
        $cms = Cms::select(['about_body', 'about_video_thumb'])->first();
        return view('frontend.about', compact('testimonials', 'cms'));
    }

    /**
     * View Faq page
     *
     *  @param  Faq
     * @return void
     */
    public function faq()
    {
        if (!enableModule('faq')) {
            abort(404);
        }
        $category_slug = request('category') ?? FaqCategory::first()->slug;
        $category = FaqCategory::where('slug', $category_slug)->first();
        $data['categories'] = FaqCategory::latest()->get(['id', 'name', 'slug', 'icon']);
        $data['faqs'] = Faq::where('faq_category_id', $category->id)->with('faq_category:id,name,icon')->get();

        return view("frontend.faq", $data);
    }

    /**
     * View Contact page
     *
     * @return void
     */
    public function contact()
    {
        if (!enableModule('contact')) {
            abort(404);
        }
        return view('frontend.contact');
    }

    /**
     * View Single Ad page
     *
     * @return void
     */
    public function adDetails(Ad $ad)
    {
        // return $ad;
        $ad->increment('total_views');
        $ad = $ad->load(['customer', 'brand', 'adFeatures', 'galleries', 'town', 'city']);

        $lists = AdResource::collection(Ad::select(['id', 'title', 'slug', 'price', 'thumbnail', 'category_id', 'city_id'])
            ->with(['city', 'category'])
            ->where('category_id', $ad->category_id)
            ->where('id', '!=', $ad->id)
            ->where('status', '!=', 'expired')
            ->latest('id')->take(10)->get());

        if ($ad->status === 'expired' && $ad->customer->id !== auth('customer')->id()) {
            return abort(404);
        } else {
            return view('frontend.single-ad', compact('ad', 'lists'));
        }
    }

    /**
     * View ad list page
     *
     * @return void
     */
    public function adList()
    {
        $data['adlistings'] = Ad::with(['category', 'city'])->latest('id')->where('status', '!=', 'expired')->paginate(21);
        $data['categories'] = Category::with('subcategories')->latest('id')->get();
        $data['cities'] = City::latest()->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['adMaxPrice'] = $price = \DB::table('ads')->max('price');

        return view('frontend.ad-list', $data);
    }

    /**
     * View Get membership page
     *
     * @return void
     */
    public function getMembership()
    {
        if (!enableModule('price_plan')) {
            abort(404);
        }

        $data['plans'] = Plan::latest()->get();
        return view('frontend.get-membership', $data);
    }

    /**
     * View Priceplan page
     *
     * @return void
     */
    public function pricePlan()
    {
        if (!enableModule('price_plan')) {
            abort(404);
        }

        $data['plans'] = Plan::all();
        return view('frontend.price-plan', $data);
    }


    /**
     * View Privacy Policy page
     *
     * @return void
     */
    public function privacy()
    {
        return view('frontend.privacy')->withCms(Cms::select(['privacy_body', 'privacy_background'])->first());
    }


    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function terms()
    {
        return view('frontend.terms')->withCms(Cms::select(['terms_body', 'terms_background'])->first());
    }

    /**
     *
     * @param int $post_id
     * @return array
     */
    public function commentsCount($post_id)
    {
        return BlogComment::where('post_id', $post_id)->count();
    }

    /**
     *
     * @param int $post_id
     * @return array
     */
    public function pricePlanDetails($plan_label)
    {
        if (!auth('customer')->check()) {
            abort(404);
        }

        $plan = Plan::where('label', $plan_label)->first();
        $payment_setting = PaymentSetting::first();
        return view('frontend.plan-details', compact('plan', 'payment_setting'));
    }



    public function adGalleryDetails(Ad $ad)
    {
        $ad->load('galleries');
        return view('frontend.single-ad-gallery', compact('ad'));
    }
}
