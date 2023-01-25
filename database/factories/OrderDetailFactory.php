<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' =>'99',
            'product_id' =>$this->faker->numberBetween(1,6),
            'quantity' => $this->faker->numberBetween(1,6),
            'total'=> $this->faker->randomFloat(2,500,5000),
            'id_user_created' => 1,
            'id_user_updated' => 1,
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
        ];
    }
}
