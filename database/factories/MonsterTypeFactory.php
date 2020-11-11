<?php

namespace Database\Factories;

use Rpg\Models\MonsterType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonsterTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MonsterType::class;

     /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
