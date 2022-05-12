<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            // RoleUserSeeder::class,
            ProfileSeeder::class,
            WalletSeeder::class,
            ServiceSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            SeriesSeeder::class,
            CarSeeder::class,
            AuctionSeeder::class,
            QuestionSeeder::class,
        ]);

    }
}
