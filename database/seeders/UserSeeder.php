<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('clients')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('clients')->insert([
            'name'        => 'Francisco',
            'last_name'   => 'Castorena',
            'middle_name' => 'Cobian',
            'phone'       => '121212',
            'email' => 'prueba@hotmail.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
        ]);
        DB::table('clients')->insert([
            'name'        => 'Cristian',
            'last_name'   => 'Sandoval',
            'middle_name' => 'Aceves',
            'email' => 'prueba1@hotmail.com',
            'phone'       => '121212',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
        ]);
        DB::table('clients')->insert([
            'name'        => 'Ricardo',
            'last_name'   => 'Gomez',
            'middle_name' => 'Casillas',
            'email' => 'prueba2@hotmail.com',
            'phone'       => '121212',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
        ]);
    }
}
