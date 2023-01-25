<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsletterUser>
 */
class NewsletterUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->mail(),
            'created_by' => 'SEEDERS',
            'updated_by' => 'SEEDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
        ];
    }
}
