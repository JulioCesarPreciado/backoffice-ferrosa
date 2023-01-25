<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_id' =>$this->faker->numberBetween(1,3),
            'address_id' =>$this->faker->numberBetween(1,6),
            'subtotal' => $this->faker->randomFloat(2,500,5000),
            'shipping' => $this->faker->randomFloat(2,500,5000),
            'tax'=> $this->faker->randomFloat(2,500,5000),
            'total'=> $this->faker->randomFloat(2,500,5000),
            'payment_method' => 'STRIPE',
            'shipping_method' => 'FEDEX',
            'id_user_created' => 1,
            'id_user_updated' => 1,
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
        ];
    }
}
