<?php

namespace Database\Factories;

use Rpg\Models\Monster;
use Illuminate\Database\Eloquent\Factories\Factory;
use Rpg;

class MonsterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Monster::class;

     /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'experience' => rand(1, 50),
            'monster_type_id' => Rpg::class('MonsterType')::factory(),
        ];
    }
}
