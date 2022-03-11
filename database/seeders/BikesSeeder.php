<?php
namespace Database\Seeders;
use App\Models\MakeModelTypeCategory;
use Modules\Brand\Entities\Brand;
//use App\Models\Category;
use App\Models\BrandModel;
use Illuminate\Support\Str;
use Modules\Category\Entities\SubCategory;
use Modules\Category\Entities\Category;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = json_decode(file_get_contents('resources/json/moto_model_list.json'));
        foreach ($cars->results as $key => $car) {
//            $gateway = Category::firstOrCreate(
//                ['name' =>  'Vehicles'],
//                ['name' => 'Vehicles', 'display_name' => 'vehicles']
//            );
            $subcat = Brand::firstOrCreate(
                ['category_id'=>2,'name' =>  $car->Make,'slug'=>Str::slug($car->Make)],
                ['category_id'=>2,'name' =>  $car->Make,'slug'=>Str::slug($car->Make)]
            );

            $model = BrandModel::firstOrCreate(
                ['brand_id'=>$subcat->id,'year' =>  $car->Year,'name' =>  $car->Model,'slug'=>Str::slug($car->Model)],
                ['brand_id'=>$subcat->id,'year' =>  $car->Year,'name' =>  $car->Model,'slug'=>Str::slug($car->Model)]
            );
//            $model = VehicleModel::firstOrCreate(
//                ['name' =>  $car->Model],
//                ['name' => $car->Model]
//            );
//            $types_arr = explode(',', $car->Category);

//            foreach ($types_arr as $key2 => $value) {
//
////                $type = Type::firstOrCreate(
////                    ['name' =>  trim($value)],
////                    ['name' => trim($value)]
////                );
//
////                MakeModelTypeCategory::firstOrCreate(
////                    [
////                        'make_id' => $make['id'],
////                        'model_id' => $model['id'],
////                        'type_id' => $type['id'],
////                        'category_id' => $gateway['id'],
////                        'model_year' => $car->Year
////                    ],
////                    [
////                        'make_id' => $make['id'],
////                        'model_id' => $model['id'],
////                        'type_id' => $type['id'],
////                        'category_id' => $gateway['id'],
////                        'model_year' => $car->Year
////                    ]
////                );
//            }
        }
    }
}
