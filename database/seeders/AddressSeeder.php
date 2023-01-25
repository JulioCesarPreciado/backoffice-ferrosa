<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('addresses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        DB::table('addresses')->insert([
            'client_id'=> 1,
            'name'=>"Francisco Javier",
            'last_name'=> "Castorena",
            'middle_name'=> "Cobian",
            'email'=> "test@hotmail.com",
            'phone'=> 3339500138,
            'address'=>  "Callejon alberto cinta",
            'country' => "Mexico",
            'state'=> "Jalisco",
            'city'=> "Zapopan",
            'zip_code'=> "45180",
            'notes'=> ".",
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        DB::table('addresses')->insert([
            'client_id'=> 1,
            'name'=>"Francisco Javier 2",
            'last_name'=> "Castorena 2",
            'middle_name'=> "Cobian 2",
            'email'=> "test2@hotmail.com",
            'phone'=> 3339500138,
            'address'=>  "Callejon alberto cinta2",
            'country' => "Mexico",
            'state'=> "Jalisco",
            'city'=> "Zapopan",
            'zip_code'=> "45180",
            'notes'=> ".",
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);



        DB::table('addresses')->insert([
            'client_id'=> 2,
            'name'=>"Cristian Omar",
            'last_name'=> "Sandoval",
            'middle_name'=> "Aceves",
            'email'=> "test3@hotmail.com",
            'phone'=> 3339500138,
            'address'=>  "Encarnacion rosas , centro",
            'country' => "Mexico",
            'state'=> "Jalisco",
            'city'=> "Guadalajara",
            'zip_code'=> "45587",
            'notes'=> ".",
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);


        DB::table('addresses')->insert([
            'client_id'=> 2,
            'name'=>"Cristian Omar 2",
            'last_name'=> "Sandoval 2",
            'middle_name'=> "Aceves 2",
            'email'=> "test4@hotmail.com",
            'phone'=> 3339500138,
            'address'=>  "Encarnacion rosas 2 , centro 2",
            'country' => "Mexico",
            'state'=> "Jalisco",
            'city'=> "Guadalajara",
            'zip_code'=> "45587",
            'notes'=> ".",
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);


        DB::table('addresses')->insert([
            'client_id'=> 3,
            'name'=>"Ricardo",
            'last_name'=> "Gomez",
            'middle_name'=> "Casillas",
            'email'=> "test5@hotmail.com",
            'phone'=> 3339500138,
            'address'=>  "Jardines alcalde",
            'country' => "Mexico",
            'state'=> "Jalisco",
            'city'=> "Guadalajara",
            'zip_code'=> "85214",
            'notes'=> ".",
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        DB::table('addresses')->insert([
            'client_id'=> 3,
            'name'=>"Ricardo 2",
            'last_name'=> "Gomez 2",
            'middle_name'=> "Casillas 2",
            'email'=> "test6@hotmail.com",
            'phone'=> 3339500138,
            'address'=>  "Jardines alcalde",
            'country' => "Mexico",
            'state'=> "Jalisco",
            'city'=> "Guadalajara",
            'zip_code'=> "85214",
            'notes'=> ".",
            'created_by' => 'SEDDERS',
            'updated_by' => 'SEDDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

    }
}
