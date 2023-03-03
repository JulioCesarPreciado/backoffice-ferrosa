<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Product;

class ProductDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_discounts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $products = Product::orderByRaw('RAND()')->take(10)->get();

        for($i = 0; $i < 10 ; $i++){
            $porcentage = $this->faker->randomFloat(2, 20, 30);
            DB::table('product_discounts')->insert([
                'product_id'            => $products[$i]->id,
                'discount_start_date'   => $this->faker->dateTimeBetween('-3 week', '-2 week'),
                'discount_end_date'     => $this->faker->dateTimeBetween('-1 week', '+1 week'),
                'percentage'            => $porcentage,
                'discount'              => round($products[$i]->price - (($products[$i]->price / 100) * $porcentage),2),
                'status'                => 'ACTIVO',
                'id_user_created'       => 1,
                'id_user_updated'       => 1,
                'created_by'            => "SEEDER",
                'updated_by'            => "SEEDER",
                'created_at'            => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_at'            => Carbon::now()->setTimezone('America/Mexico_City'),
            ]);
        }
    }
}
