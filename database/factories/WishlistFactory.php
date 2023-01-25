<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $products = Product::all()->pluck('id');

        return [
            'product_id' => $this->faker->randomElement($products),
            'client_id' => User::find(1)->id,
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS'
        ];
    }
}
