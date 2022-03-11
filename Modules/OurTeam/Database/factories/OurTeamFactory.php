<?php

namespace Modules\OurTeam\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OurTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\OurTeam\Entities\OurTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true);
        $position = $this->faker->sentence($nbWords = 8, $variableNbWords = true);

        return [
            'name' => $title,
            'position' => $position,
            'description' => $this->faker->paragraph,
        ];
    }
}
