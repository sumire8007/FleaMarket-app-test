<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'item_name'=> $this->faker->text(10),
            'price'=> $this->faker->numberBetween(100,100000),
            'detail'=> $this->faker->sentence(),
            'item_img'=> 'test.png',
            'condition'=> $this->faker->randomElement(['良好','目立った傷や汚れなし','やや傷や汚れあり','状態が悪い']),
        ];
    }
}
