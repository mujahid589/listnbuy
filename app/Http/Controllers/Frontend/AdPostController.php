<?php

namespace App\Http\Controllers\Frontend;

use App\Models\AdVideo;
use App\Models\BrandModel;
use App\Models\Deal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Modules\Ad\Entities\AdGallery;
use Modules\Brand\Entities\Brand;
use App\Http\Controllers\Controller;
use App\Http\Traits\AdCreateTrait;
use Modules\Category\Entities\Category;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Modules\Plan\Entities\Plan;

use Auth;

use App\Models\Transmission;
use App\Models\Drive;
use App\Models\Fuel;
use App\Models\Condition;
use App\Models\TitleStatus;
use App\Models\VehicleBodyType;

class AdPostController extends Controller
{
    use AdCreateTrait;

    /**
     * Ad Create step 1.
     * @return void
     */
    public function postStep1()
    {
        $this->stepCheck();
        if (session('step1')) {
            $data = [];
//            $categories = Category::latest('id')->get();
//            $brands = Brand::latest('id')->get();
//            $models = BrandModel::latest('id')->get();

            $categories = Category::all();
            $types= Plan::all();
            $brands = Brand::all();
            $models = BrandModel::all();
            $transmissions = Transmission::all();
            $conditions = Condition::all();
            $title_statuses = TitleStatus::all();
            $drives = Drive::all();
            $states = City::all();
            $citis = City::all();
            $fuels = Fuel::all();
            $plans = Plan::all();
            $body_types = VehicleBodyType::all();
            $ad_id = session('ad_id');
            $ad=Ad::where('id',$ad_id)->first();
            //return $ad->vehicleFeatures->vehicle_body_type ;
              //dd($ad);
           // var_dump($ad);
            if($ad){
                return view('frontend.postad.step1',compact('categories','types',
                    'brands','models','transmissions','conditions',
                    'title_statuses','drives','states','citis','fuels','plans','body_types','ad') );
            }else{


                return view('frontend.postad.step1',compact('categories','types',
                    'brands','models','transmissions','conditions',
                    'title_statuses','drives','states','citis','fuels','plans','body_types') );
            }


        } else {
            return redirect()->route('frontend.post');
        }
    }

    /**
     * Ad Create step 2.
     *
     * @return void
     */
    public function postStep2()
    {
        if (session('step2')) {
            $ad = session('ad');
            $citis = City::latest('id')->get();

            return view('frontend.postad.step2', compact('ad', 'citis'));
        } else {
            return redirect()->route('frontend.post');
        }
    }

    /**
     * Ad Create step 3.
     *
     * @return void
     */
    public function postStep3()
    {
        $data['plans'] = Plan::all();
        return view('frontend.postad.step3',$data);

        if (session('step3')) {
            $data['plans'] = Plan::all();
            return view('frontend.postad.step3',$data);
        } else {
            return redirect()->route('frontend.post');
        }
    }

    /**
     * Store Ad Create step 1.ul Islam <devboyarif@gmail.com>
     *  @param  Request $request
     * @return void
     */
    public function storePostStep1(Request $request)
    {

        $validatedData = $request->validate([
        //  'title' => 'required|unique:ads,title',
            'price' => 'required|numeric',
            'model' => 'required',
            'condition' => 'required',
            'authenticity' => 'required',
            'negotiable' => 'required',
            'featured' => 'sometimes',
            'category_id' => 'required',
            'subcategory_id' => 'sometimes',
            'brand_id' => 'required',
            'suggested_retail_price'=>'required',
            'phone' => 'required',
        //  'phone_2' => 'sometimes',
            'city_id' => 'required',
            'town_id' => 'required',
            'description' => 'required',
        //  'images' => 'required',
            'images' => 'required',
            'thumbnail'=>'required',
            'video'=>'required',
        ]);
          $ad_id=session('ad_id');
          $title='';
        if($request->category_id==1
            || $request->category_id==2
            || $request->category_id==3
            || $request->category_id==6
        ){
            //BrandModel::where('brand_id',)
         $title= $request->model_year." ".$request->brand." ".$request->model;
        }else{
            $title=$request->tittle;
        }
        $ad = new Ad();
        $ad['slug'] = Str::slug($title);
        $ad['title'] = $title;
        $ad['price'] = $request->price;
        $ad['model'] = $request->model;
        $ad['condition'] = $request->condition;
        $ad['authenticity'] = $request->authenticity;
        $ad['negotiable'] = $request->negotiable;
        $ad['featured'] =$request->featured;
        $ad['category_id'] = $request->category_id;
        $ad['subcategory_id'] = $request->subcategory_id;
        $ad['brand_id'] = $request->brand_id;
        $ad['suggested_retail_price'] = $request->suggested_retail_price;
        $ad['description'] = $request->description;
        $ad['phone'] = $request->phone;
        $ad['city_id'] = $request->city_id;
        $ad['town_id'] = $request->town_id;
        $ad['customer_id'] = auth('customer')->id();

        $ad['thumbnail'] = uploadImage($request->thumbnail, 'images');

        //$ad->fill($validatedData);
        //$request->session()->put('ad', $ad);
        $ad->save();
        if($request->category_id==1
            || $request->category_id==2
            || $request->category_id==3
            || $request->category_id==6
        ){

        

            $request->session()->put('ad_id', $ad->id);



            $video_url = uploadImage($request->video, 'videos');
            $ad->video()->updateOrCreate([],['video' => $video_url]);

            // image uploading
            $images = $request->file('images');
            foreach ($images as $key => $image) {
                if ($key == 0) {
                    $url = uploadImage($image, 'images');
                }
                $url = uploadImage($image, 'ad_multiple');
                $ad->galleries()->create(['image' => $url]);
            }



            // return view('frontend.postad.postsuccess', [
            //    'ad_slug' => Str::slug($title),
            //    'mode' => 'create'
            // ]);

        }

        return 1;

    }

    /**
     * Store Ad Create step 2.
     *  @param  Request $request
     * @return void
     */
    public function storePostStep2(Request $request)
    {

        $validatedData = $request->validate([
            'images' => 'required',
            'thumbnail'=>'required',
            'video'=>'required'
        ]);

        $ad = session('ad');

        $ad_id = $request->session()->get('ad_id');
        $adhere=new Ad();
        $ad =$adhere::find($ad_id);

        //dd($ad);

        $url = uploadImage($request->thumbnail, 'images');
        $ad->update(['thumbnail' => $url]);

        $video_url = uploadImage($request->video, 'videos');
        $ad->video()->updateOrCreate([],['video' => $video_url]);
        //$video = new AdVideo(['video' => $video_url]);
        //$ad->video()->save($video);


        //AdVideo::create(['ad_id'=>$ad_id,'video' => $video_url]);

        // image uploading
        $images = $request->file('images');
        foreach ($images as $key => $image) {
            if ($key == 0) {
                $url = uploadImage($image, 'images');
            }
            $url = uploadImage($image, 'ad_multiple');
            $ad->galleries()->create(['image' => $url]);
            //AdGallery::create(['ad_id'=>$ad_id,'image' => $url]);
        }


        $this->step1Success2();
        return redirect()->route('frontend.post.step3');
    }

    /**
     * Store Ad Create step 3.
     *  @param  Request $request
     * @return void
     */
    public function storePostStep3(Request $request)
    {
        // $validatedData = $request->validate([
        //     'advert_type' => 'required',
        // ]);


        $ad = session('ad_id');
        $ads = Ad::where('id',$ad)->get();


        
        // $this->forgetStepSession();
        // $this->adNotification($ads[0]);
        // $this->userPlanInfoUpdate($ads[0]->featured);

       return view('frontend.postad.postsuccess', [
           'ad_slug' => $ads[0]->slug,
           'mode' => 'create'
       ]);
    }

    /**
     * Ad Edit step 1.
     * @return void
     */
    public function editPostStep1(Ad $ad)
    {
        if (auth('customer')->id() == $ad->customer_id) {
            $this->stepCheck();
            session(['edit_mode' => true]);

            if (session('step1') && session('edit_mode')) {
                $ad = collectionToResource($this->setAdEditStep1Data($ad));
                $categories = Category::latest('id')->get();
                $brands = Brand::latest('id')->get();

                return view('frontend.postad_edit.step1', compact('ad', 'categories', 'brands'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }

    /**
     * Ad Edit step 2.
     *
     * @return void
     */
    public function editPostStep2(Ad $ad)
    {
        if (auth('customer')->id() == $ad->customer_id) {
            $ad = collectionToResource($this->setAdEditStep2Data($ad));

            if (session('step2') && session('edit_mode')) {
                $citis = City::latest('id')->get();

                return view('frontend.postad_edit.step2', compact('ad', 'citis'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }


    /**
     * Edit Ad step 3.
     *
     * @return void
     */
    public function editPostStep3(Ad $ad)
    {
        $ad->load('adFeatures', 'galleries');

        if (auth('customer')->id() == $ad->customer_id) {
            $ad = collectionToResource($this->setAdEditStep3Data($ad));

            if (session('step3') && session('edit_mode')) {
                return view('frontend.postad_edit.step3', compact('ad'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }

    /**
     * Update Ad step 1.ul Islam <devboyarif@gmail.com>
     *  @param  Request $request
     * @return void
     */
    public function UpdatePostStep1(Request $request, Ad $ad)
    {
        $request->validate([
            'title' => "required|unique:ads,title,$ad->id",
            'price' => 'required|numeric',
            'model' => 'required',
            'condition' => 'required',
            'authenticity' => 'required',
            'negotiable' => 'sometimes',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        $ad->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'model' => $request->model,
            'condition' => $request->condition,
            'authenticity' => $request->authenticity,
            'negotiable' => $request->negotiable,
            'featured' => $request->featured,
        ]);


        if ($request->cancel_edit) {
            $this->forgetStepSession();
            return redirect()->route('frontend.dashboard');
        } else {
            $this->step1Success();
            return redirect()->route('frontend.post.edit.step2', $ad->slug);
        }
    }

    /**
     * Update Ad step 2.
     *  @param  Request $request
     * @return void
     */
    public function updatePostStep2(Request $request, Ad $ad)
    {
        $request->validate([
            'phone' => 'required',
            'phone_2' => 'sometimes',
            'city_id' => 'required',
            'town_id' => 'required',
        ]);

        $ad->update([
            'phone' => $request->phone,
            'phone_2' => $request->phone_2,
            'city_id' => $request->city_id,
            'town_id' => $request->town_id,
        ]);

        if ($request->cancel_edit) {
            $this->forgetStepSession();
            return redirect()->route('frontend.dashboard');
        } else {
            $this->step1Success2();
            return redirect()->route('frontend.post.edit.step3', $ad->slug);
        }
    }

    /**
     * Update Ad step 3.
     *  @param  Request $request
     * @return void
     */
    public function updatePostStep3(Request $request, Ad $ad)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $ad->update(['description' => $request->description]);

        // feature inserting
        $ad->adFeatures()->delete();
        foreach ($request->features as $feature) {
            if ($feature) {
                $ad->adFeatures()->create(['name' => $feature]);
            }
        }

        // image uploading
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                $url = uploadImage($image, 'ad_multiple');
                $ad->galleries()->create(['image' => $url]);
            }
        }

        $this->forgetStepSession();
        $this->adNotification($ad, 'update');

        return view('frontend.postad.postsuccess', [
            'ad_slug' => $ad->slug,
            'mode' => 'update',
        ]);
    }

    /**
     * Cancel Ad Edit.
     * @return void
     */
    public function cancelAdPostEdit()
    {
        $this->forgetStepSession();
        return redirect()->route('frontend.dashboard');
    }

    public function getPostAdPage(){
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

        return view('frontend.postad.post_ads', $data);
    }

    public function uploadThumbnail(Request $request){

        try{
                $validatedData = $request->validate([
                    'images' => 'required',
                    'thumbnail'=>'required',
                    'video'=>'required'
                ]);

                $ad = session('ad');
                //$ad['description'] = $validatedData['description'];
                $ad['customer_id'] = auth('customer')->id();
                $request->session()->put('ad', $ad);
                $ad->save();

                $url = uploadImage($request->thumbnail, 'images');
                $ad->update(['thumbnail' => $url]);

                // image uploading
                $images = $request->file('images');
                foreach ($images as $key => $image) {
                    if ($key == 0) {
                        $url = uploadImage($image, 'images');
                    }
                    $url = uploadImage($image, 'ad_multiple');
                    $ad->galleries()->create(['image' => $url]);
                }

                $this->forgetStepSession();
                $this->adNotification($ad);
                $this->userPlanInfoUpdate($ad->featured);

        }catch (\Exception $e)
        {
            return response('error',400);

        }

    }

    public function uploadImages(Request $request){

        try{
            $validatedData = $request->validate([
                'images' => 'required',
                'thumbnail'=>'required',
                'video'=>'required'
            ]);

            $ad = session('ad');
            //$ad['description'] = $validatedData['description'];
            $ad['customer_id'] = auth('customer')->id();
            $request->session()->put('ad', $ad);
            $ad->save();

            $url = uploadImage($request->thumbnail, 'images');
            $ad->update(['thumbnail' => $url]);

            // image uploading
            $images = $request->file('images');
            foreach ($images as $key => $image) {
                if ($key == 0) {
                    $url = uploadImage($image, 'images');
                }
                $url = uploadImage($image, 'ad_multiple');
                $ad->galleries()->create(['image' => $url]);
            }

            $this->forgetStepSession();
            $this->adNotification($ad);
            $this->userPlanInfoUpdate($ad->featured);

        }catch (\Exception $e)
        {
            return response('error',400);

        }

    }

    public function uploadVideo(Request $request){

        try{
            $validatedData = $request->validate([
                'images' => 'required',
                'thumbnail'=>'required',
                'video'=>'required'
            ]);

            $ad = session('ad');
            //$ad['description'] = $validatedData['description'];
            $ad['customer_id'] = auth('customer')->id();
            $request->session()->put('ad', $ad);
            $ad->save();

            $url = uploadImage($request->thumbnail, 'images');
            $ad->update(['thumbnail' => $url]);

            // image uploading
            $images = $request->file('images');
            foreach ($images as $key => $image) {
                if ($key == 0) {
                    $url = uploadImage($image, 'images');
                }
                $url = uploadImage($image, 'ad_multiple');
                $ad->galleries()->create(['image' => $url]);
            }

            $this->forgetStepSession();
            $this->adNotification($ad);
            $this->userPlanInfoUpdate($ad->featured);

        }catch (\Exception $e)
        {
            return response('error',400);

        }

    }

    public function fetchUploadedImages(Request $request)
    {
        $post = Post::find($request->post_id);
        return $post->all_images;
    }

    public function fetchUploadedVideo(Request $request)
    {
        $post = Post::find($request->post_id);
        return $post->all_video;
    }

    public function rateUser(){

    }

    public function makeDeal(Request  $request){
        try {


            $deal = new Deal();
            $deal->name = Auth::user()->id;
            $deal->email = Auth::user()->email;
            $deal->phone = Auth::user()->phone;
            $deal->message = $request->message;
            $deal->amount = $request->amount;
            $deal->ads_id = $request->ad_id;
            $deal->save();

            return Response::json([
                'data'=>"deal saved successfully"
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);

        }
    }

}
