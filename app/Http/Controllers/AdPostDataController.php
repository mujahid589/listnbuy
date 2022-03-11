<?php

namespace App\Http\Controllers;

use App\Models\BikesBodyType;
use App\Models\VehicleBodyType;
use Illuminate\Http\Request;
use Modules\Category\Entities\SubCategory;

class AdPostDataController extends Controller
{
    /**
     * Get subcateogry by category id
     * @param int $category_id
     * @return \Illuminate\Http\Response
     */
    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->latest()->get()->map(fn ($item) => [
            'id' => $item->id,
            'name' => $item->name,
        ]);
        return response()->json($subcategories);
    }

    public function getModelByCategory($category_id){

    }

    public function getMakeByCategory($category_id){

    }

    public function getBodyTypeByCategory($category_id){
        try{

            $data = [];
            if($category_id=1) {
                $data['body_types']= VehicleBodyType::all();
            }else {
                $data['body_types']= BikesBodyType::all();
            }
            return Response::json([
                'data'=>$data
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);

        }
    }
}
