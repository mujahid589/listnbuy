<?php

namespace Database\Seeders;

use Database\Seeders\CmsSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ThemeSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\CarSeeder;
use Database\Seeders\BikesSeeder;
use Database\Seeders\PartsSeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\RolePermissionSeeder;
use Modules\Faq\Database\Seeders\FaqCategorySeeder;
use Modules\Plan\Database\Seeders\PlanDatabaseSeeder;
use Modules\Newsletter\Database\Seeders\NewsletterDatabaseSeeder;

use App\Models\Transmission;
use App\Models\Drive;
use App\Models\Fuel;
use App\Models\Condition;
use App\Models\TitleStatus;
use App\Models\VehicleBodyType;
use App\Models\BikesBodyType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


//        $bodytypes = [['name' => 'Convertible'], ['name' => 'Coupe'], ['name' => 'Hatchback'],['name' => 'Sedan'],
//            ['name' => 'SUV'],['name' => 'SUV1992'],['name' => 'SUV2020'],
//            ['name' => 'Truck'],['name' => 'Van/Minivan'],['name' => 'Wagon'],['name' => 'Other']];
//        foreach ($bodytypes as $bodytype) {
//            VehicleBodyType::create($bodytype);
//        }
//        $bikestypes = [['name' => 'Allround'], ['name' => 'Classic'], ['name' => 'Naked bike'],['name' => 'Sport'],
//            ['name' => 'Sport touring'],['name' => 'Touring'],['name' => 'Unspecified category']];
//        foreach ($bikestypes as $bikestype) {
//            BikesBodyType::create($bikestype);
//        }

//        $transmissions = [['name' => 'Manual'], ['name' => 'Automatic'], ['name' => 'Other']];
//        foreach ($transmissions as $transmission) {
//            Transmission::create($transmission);
//        }
//
//        $fuels = [['name' => 'Gas'], ['name' => 'Diesel'], ['name' => 'Electric'], ['name' => 'Hybrid'], ['name' => 'Other']];
//        foreach ($fuels as $fuel) {
//            Fuel::updateOrCreate($fuel, $fuel);
//        }
//
//        $conditions = [['name' => 'New'], ['name' => 'Used']];
//        foreach ($conditions as $condition) {
//            Condition::updateOrCreate($condition, $condition);
//        }
//
//        $title_statuses = [
//            ['name' => 'Clean'], ['name' => 'Salvage'], ['name' => 'Rebuilt'], ['name' => 'Missing']
//        ];
//        foreach ($title_statuses as $condition) {
//            TitleStatus::updateOrCreate($condition, $condition);
//        }
//
//        $drives = [
//            ['name' => 'FWD'], ['name' => 'RWD'], ['name' => '4WD'], ['name' => '2WD']
//        ];
//        foreach ($drives as $drive) {
//            Drive::updateOrCreate($drive, $drive);
//        }
        $this->call([
//            RolePermissionSeeder::class, // Role Permission
//            SettingSeeder::class, // Setting
//            UserSeeder::class, // User
//            FaqCategorySeeder::class, //FAQ Category
//            ThemeSeeder::class, // Theme
//            PlanDatabaseSeeder::class, //priceplan
//            CmsSeeder::class, //Cms settings
             // CarSeeder::class, //Cms settings
            //StateSeeder::class, //Cms settings

            //PartsSeeder::class, //parts seeder
            //BikesSeeder::class
        ]);
    }
}
