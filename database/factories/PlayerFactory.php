<?php

namespace Database\Factories;

use Rpg\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Rpg;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

     /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'biography' => $this->faker->text,
            'experience' => 0,
            'level' => 1,
            'title_id' => Rpg::class('Title')::factory(),
            'zone_id' => Rpg::class('Zone')::factory()
        ];
    }
}
