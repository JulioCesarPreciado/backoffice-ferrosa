<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('seos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Agrego los datos
        DB::table('seos')->insert([
            'meta_author' => 'Perspective Global de México',
            'meta_keyword' => 'ecommerce, tienda online',
            'meta_description' => 'Ecommerce',
            'google_analytics' => '',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
        
        ]);
    }
}
