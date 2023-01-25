<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class Config extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           // Elimino los datos que pueda tener, ya que solo deberia tener un registro
           DB::table('configs')->truncate();

           // Agrego los datos
           DB::table('configs')->insert([
               'name' => 'Example',
               'color' => 'pink',
               'icon' => '_',
               'logo' => '_',
               'background' => '_',
               'shade' => '700',
               'created_by' => 'SEEDER',
               'updated_by' => 'SEEDER',
               'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
               'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
           ]);
    }
}
