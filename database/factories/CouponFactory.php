<?php

namespace Database\Factories;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupons>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'discount' => $this->faker->numberBetween(1,99),
            'qty' => $this->faker->numberBetween(1,20),
            'initial_date' => Carbon::now()->setTimezone('America/Mexico_City'),
            'final_date' =>   Carbon::now()->setTimezone('America/Mexico_City'),
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
        ];
    }
}
