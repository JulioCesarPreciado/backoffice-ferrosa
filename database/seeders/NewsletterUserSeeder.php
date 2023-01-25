<?php

namespace Database\Seeders;

use App\Models\NewsletterUser;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsletterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('newsletter_users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Esto es para correos fake
        // NewsletterUser::factory(7)->create();

        // Agrego un registro
        DB::table('newsletter_users')->insert([
            'email' => 'memofenton@gmail.com',
            'created_by' => 'SEEDERS',
            'updated_by' => 'SEEDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego un registro
        DB::table('newsletter_users')->insert([
            'email' => 'guillermo.alcaraz@perspective.com.mx',
            'created_by' => 'SEEDERS',
            'updated_by' => 'SEEDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego un registro
        DB::table('newsletter_users')->insert([
            'email' => 'julio.preciado@perspective.com.mx',
            'created_by' => 'SEEDERS',
            'updated_by' => 'SEEDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego un registro
        DB::table('newsletter_users')->insert([
            'email' => 'esteban@perspective.com.mx',
            'created_by' => 'SEEDERS',
            'updated_by' => 'SEEDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego un registro
        DB::table('newsletter_users')->insert([
            'email' => 'francisco.castorena@perspective.com.mx',
            'created_by' => 'SEEDERS',
            'updated_by' => 'SEEDERS',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);
    }
}
