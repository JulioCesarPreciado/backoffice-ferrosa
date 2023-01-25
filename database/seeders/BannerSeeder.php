<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('banners')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Storage::deleteDirectory("upload/banner/");
        Banner::factory(20)->create();
    }
}
