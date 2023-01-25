<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Elimino los datos que pueda tener, ya que solo deberia tener un registro
        DB::table('contacts')->truncate();

        // Agrego los datos
        DB::table('contacts')->insert([
            'company_name' => 'company name',
            'address' => 'address',
            'email' => 'Example@PGM.com',
            'phone' => '123456789',
            'working_hours' => '9 am - 10 pm',
            'facebook' => 'https://wwww.facebook.com',
            'twitter' => 'https://wwww.twitter.com',
            'linkedin' => 'https://wwww.linkedin.com',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);
    }
}
