<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => 'password',
        //     'is_admin' => 'true'
        // ]);
        // seed category
        //    create custom user
        \App\Models\User::factory()->create([
            'name' => 'admin delivery',
            'username' => 'adm_delivery',
            'email' => 'admdelivery@dominion.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_admin' => 1,
        ]);

        \App\Models\Category::factory(5)->create();
    }
}
