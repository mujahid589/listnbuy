<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\Cms;
use App\Models\Condition;
use App\Models\Drive;
use App\Models\Fuel;
use App\Models\TitleStatus;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Modules\Category\Transformers\CategoryResource;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdResource;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Modules\Plan\Entities\Plan;
use Response;

class AdsApiController extends Controller
{
    public function getAdsByCategory($name){


        try{

            $data = [];
            $query = Ad::with(['category', 'city']);

            if ($category = SubCategory::where('name', $name)->first()) {
                $query->where('subcategory_id', $category->id)->where('status', '!=', 'expired');
            } else if ($category = Category::where('name', $name)->first()) {
                $query->where('category_id', $category->id)->where('status', '!=', 'expired');
            } else {
                return response('error',404);
            }

            $data['basic'] = $query->where('advert_type','basic')->paginate(request('per_page', 12))->withQueryString();
            $data['premium'] = $query->where('advert_type','premium')->paginate(request('per_page', 12))->withQueryString();
            $data['premium_plus'] = $query->where('advert_type','premium plus')->paginate(request('per_page', 12))->withQueryString();


            return Response::json([
                'data'=>$data
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);

        }


    }

    public function getAllAdsByCategory($name){


        try{

            $data = [];
            $query = Ad::with(['category', 'city']);

            if ($category = SubCategory::where('name', $name)->first()) {
                $query->where('subcategory_id', $category->id)->where('status', '!=', 'expired');
            } else if ($category = Category::where('name', $name)->first()) {
                $query->where('category_id', $category->id)->where('status', '!=', 'expired');
            } else {
                return response('error',404);
            }

            $data['adlistings'] = $query->paginate(request('per_page', 12))->withQueryString();


            return Response::json([
                'data'=>$data
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);

        }
    }


    /**
     * get Single Ad page data
     *
     * @return void
     */
    public function adDetails(Ad $ad)
    {
        try {
             //return $ad;
            $ad->increment('total_views');
            $ad = $ad->load(['customer', 'brand', 'adFeatures', 'galleries', 'town', 'city']);

            $lists = AdResource::collection(Ad::select(['id', 'title', 'slug', 'price', 'thumbnail', 'category_id', 'city_id'])
                ->with(['city', 'category'])
                ->where('category_id', $ad->category_id)
                ->where('id', '!=', $ad->id)
                ->where('status', '!=', 'expired')
                ->latest('id')->take(10)->get());

            if ($ad->status === 'expired' && $ad->customer->id !== auth('customer')->id()) {
                return response('error',404);
            } else {

                return Response::json([
                    'ad'=>$ad,
                    'similarads'=>$lists
                ],200);
            }
        } catch (\Exception $e)
        {
//            return Response::json([
//                'data'=>$e
//            ],400);
            return response('error',400);



        }
    }

    public function getAdsDropDownData(){

        try{

            $data = [];
            $user = Auth::user();

            $data['categories'] = Category::all();
            $data['types'] = Plan::all();
            $data['makes'] = Brand::all();
            $data['models'] = BrandModel::all();
            $data['transmissions'] = Transmission::all();
            $data['conditions'] = Condition::all();
            $data['title_statuses'] = TitleStatus::all();
            $data['drives'] = Drive::all();
            $data['states'] = City::all();
            $data['cities'] = Town::all();
            $data['fuels'] = Fuel::all();
            $data['plans'] = Plan::all();
            $data['current_plan'] = [
                "active_plan" => isset($user->userPlan) ? $user->userPlan->label : null,
                "available_units" => isset($user->userPlan) ? $user->userPlan->ad_limit : null
            ];

            return Response::json([
                'data'=>$data
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);

        }
    }
}
