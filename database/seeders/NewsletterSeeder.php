<?php

namespace Database\Seeders;

use App\Models\Newsletter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('newsletters')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Newsletter::factory(7)->create();
    }
}
