<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(Admins::class);
        // $this->call(Config::class);
        // $this->call(BannerSeeder::class);
        // $this->call(SeoSeeder::class);
        // $this->call(FaqSeeder::class);
        // $this->call(AboutSeeder::class);
        // $this->call(ContactSeeder::class);
        // $this->call(NewsletterSeeder::class);
        // $this->call(NewsletterUserSeeder::class);
        // $this->call(CouponSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
