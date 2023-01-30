<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'subtitle' => rand(0, 1) ? null : $this->faker->sentence(3),
            'url' => rand(0, 1) ? null : $this->faker->url,
            'thumbnail' => env('APP_URL') . "/" ."imagenes-banners/".generateImagesRandom(
                $this->faker->word . $this->faker->word,
            ),
            'type'=>$this->faker->randomElement(['colecciones', 'descuentos']),
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
        ];
    }
}
