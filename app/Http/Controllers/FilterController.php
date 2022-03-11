<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\Theme;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Modules\Category\Transformers\CategoryResource;
use Modules\Location\Entities\City;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Modules\Location\Entities\Town;

class FilterController extends Controller
{
    /**
     * Search & filter post by keyword, category
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $query = Ad::with('city', 'category')->where('status', '!=', 'expired');

        if ($request->has('category') && $request->category != null) {
            $category = $request->category;

            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        if ($request->has('subcategory') && $request->subcategory != null) {
            $subcategory = $request->subcategory;

            $query->whereHas('subcategory', function ($q) use ($subcategory) {
                $q->whereIn('slug', $subcategory);
            });
        }

        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        if ($request->has('town') && $request->town != null) {
            $query->whereHas('town', function ($q) {
                $q->where('name', request('town'));
            });
        }

        if ($request->has('city') && $request->city != null) {
            $query->whereHas('city', function ($q) {
                $q->where('name', request('city'));
            });
        }


        if ($request->has('seller_type') && $request->seller_type != null) {
            // $query->where('title', 'LIKE',"%$request->keyword%");
        }

        if ($request->has('condition') && $request->condition != null) {
            $query->where('condition', $request->condition);
        }

        if ($request->has('price_min') && $request->price_min != null) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max != null) {
            $query->where('price', '<=', $request->price_max);
        }

        $data['adlistings'] =  $query->paginate(request('per_page', 15))->withQueryString();
        $data['categories'] = Category::with('subcategories')->latest('id')->get();
        $data['cities'] = City::latest()->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['adMaxPrice'] = $price = \DB::table('ads')->max('price');

        return view('frontend.ad-list', $data);
    }


    public function adsByCategory($slug)
    {
        $query = Ad::with(['category', 'city','VehicleFeatures']);

        $topCategories = CategoryResource::collection(Category::with('subcategories')->withCount('ads as ad_count')->latest('ad_count')->take(8)->get());

        $data['topCategories'] = collectionToResource($topCategories);


        if ($category = SubCategory::where('slug', $slug)->first()) {
            $query->where('subcategory_id', $category->id)->where('status', '!=', 'expired');
        } else if ($category = Category::where('slug', $slug)->first()) {
            $query->where('category_id', $category->id)->where('status', '!=', 'expired');
        } else {
            return abort(404);
        }

        $data['adlistings'] = $query->paginate(request('per_page', 12))->withQueryString();
        $data['category'] =  $category;


        $cms = Cms::first();



        if (stristr($category->name,'vehicles') ){
            $data['headerimage'] =  $cms->vehicles_header;
        }elseif (stristr($category->name,'motorbike')){
            $data['headerimage'] =  $cms->motorbikes_header;
        }elseif (stristr($category->name,'parts')){
            $data['headerimage'] =  $cms->auto_parts_header;
        }elseif (stristr($category->name,'general')){
            $data['headerimage'] =  $cms->general_header;
        }elseif (stristr($category->name,'handy')){
            $data['headerimage'] =  $cms->handy_man_header;
        } elseif (stristr($category->name,'rent')){
            $data['headerimage'] =  $cms->vehicles_header;
        }elseif (stristr($category->name,'junk')){
            $data['headerimage'] =  $cms->junk_cars_header;
        }else{
            $data['headerimage'] =  $cms->coming_soon_header;
        }

        //dd($data);

        return view('frontend.category-ads', $data);
    }
}
