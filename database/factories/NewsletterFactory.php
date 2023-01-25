<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Newsletter>
 */
class NewsletterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'content' => $this->faker->word() . '.jpg',
            'sent' => rand(0, 1) ? null : rand(1, 100),
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
        ];
    }
}
