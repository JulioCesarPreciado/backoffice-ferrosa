<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('wishlists')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Wishlist::factory(30)->create();
    }
}
