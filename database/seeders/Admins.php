<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Admins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('admins')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('admins')->insert([
            'name'        => 'User',
            'last_name'   => 'Test',
            'email' => 'test@test.com',
            'password' => bcrypt('test'),
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);
    }
}
