<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;

class AdsPostApiController extends Controller
{
    public function storeAdsPost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:ads,title',
            'price' => 'required|numeric',
            'model' => 'required',
            'condition' => 'required',
            'authenticity' => 'required',
            'negotiable' => 'required',
            'featured' => 'sometimes',
            'category_id' => 'required',
            'subcategory_id' => 'sometimes',
            'brand_id' => 'required',
            'phone' => 'required',
            'phone_2' => 'sometimes',
            'city_id' => 'required',
            'town_id' => 'required',
            'description' => 'required',
            'images' => 'required',
        ]);

//        if (empty(session('ad'))) {
//            $ad = new Ad();
//            $ad['slug'] = Str::slug($request->title);
//            $ad->fill($validatedData);
//            $request->session()->put('ad', $ad);
//        } else {
//            $ad = session('ad');
//            $ad['slug'] = Str::slug($request->title);
//            $ad->fill($validatedData);
//            $request->session()->put('ad', $ad);
//        }
//
//        $this->step1Success();
//        return redirect()->route('frontend.post.step2');


        $ad = new Ad();
        $ad->title = $request->title;
        $ad->slug = Str::slug($request->title);
        $ad->customer_id = auth('customer')->id();
        $ad->category_id = $request->category_id;
        $ad->subcategory_id = $request->subcategory_id;
        $ad->brand_id = $request->brand_id;
        $ad->city_id = $request->city_id;
        $ad->town_id = $request->town_id;
        $ad->model = $request->model;
        $ad->condition = $request->condition;
        $ad->authenticity = $request->authenticity;
        $ad->negotiable = $request->negotiable ? $request->negotiable : 0;
        $ad->price = $request->price;
        $ad->description = $request->description;
        $ad->phone = $request->phone;
        $ad->phone_2 = $request->phone_2;
        $ad->featured = $request->featured ? $request->featured : 0;
        $ad->save();

        // image uploading
        $images = $request->file('images');
        foreach ($images as $key => $image) {
            if ($key == 0) {
                $url = uploadImage($image, 'images');
                $ad->update(['thumbnail' => $url]);
            }

            $url = uploadImage($image, 'ad_multiple');
            $ad->galleries()->create(['image' => $url]);
        }

        // feature inserting

        $features = $request->features;
        if($features==null || empty($features)) {

        }else{
            foreach ($features as $feature) {
                $ad->adFeatures()->create(['name' => $feature]);
            }
        }

        //$this->forgetStepSession();
        //$this->adNotification($ad);
        $this->userPlanInfoUpdate($ad->featured);

        return view('frontend.postad.postsuccess', [
            'ad_slug' => $ad->slug,
            'mode' => 'create'
        ]);
    }
}
