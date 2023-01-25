<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'sku' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2,500,5000),
            'thumbnail' => 'https://picsum.photos/1000/640',
            'quantity' => $this->faker->randomFloat(2,1,200),
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
        ];
    }
}
