<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Payment;
use App\Models\Item;
use App\Models\Address;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payment_id' => Payment::factory(),
            'user_id' => User::factory(),
            'item_id' => Item::factory(),
            'address_id'=> Address::factory(),
        ];
    }
}
