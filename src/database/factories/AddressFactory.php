<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Address;


class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Address::class;
    public function definition()
    {
        return [
            // 'user_id' => User::factory(),
            'user_img' => 'test.png',
            'post_code'=> $this->faker->numberBetween(100, 999).'-'. $this->faker->numberBetween(1000, 9999),
            'address'=> $this->faker->city().$this->faker->streetAddress(),
            'building'=> $this->faker->secondaryAddress(),
        ];
    }
}
