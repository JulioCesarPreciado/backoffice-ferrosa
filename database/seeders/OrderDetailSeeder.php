<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('order_details')->truncate();
        OrderDetail::factory(3)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
