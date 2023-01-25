<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Elimino los datos que pueda tener, ya que solo deberia tener un registro
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        DB::table('reviews')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); 

        // Agrego los datos
        DB::table('reviews')->insert([
            
            'product_id' => 1,
            'client_id' => 1,
            'rating' => 5,
            'message' => 'especial atencion para castorena',
            'name' => 'juan de alba',
            'title' => 'La mejor compra de mi vida',
            'email' => 'test@test.com',
            'status' => 'comprado',
            'validity' => 'validado',
            'created_by' => 'SEDDER',
            'updated_by' => 'SEDDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);
    }
}
