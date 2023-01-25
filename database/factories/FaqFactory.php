<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question' => $this->faker->realText(rand(200, 300)) . '?',
            'answer' => $this->faker->realText(rand(200, 500)),
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
        ];
    }
}
