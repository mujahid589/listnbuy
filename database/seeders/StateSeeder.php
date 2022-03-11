<?php
namespace Database\Seeders;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = json_decode(file_get_contents('resources/json/states.json'));
        foreach ($json as $value) {
            $state = City::updateOrCreate(['name' => $value->state_name], [
                'name' => $value->state_name
            ]);

            Town::updateOrCreate(['name' => $value->city, 'city_id' => $state->id], ['name' => $value->city, 'city_id' => $state->id]);
        }
    }
}
