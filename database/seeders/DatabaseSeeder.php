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
            'name' => 'admin',
            'username' => 'adm',
            'email' => 'adm@dominion.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'gender' => 'F',
            'phone' => '081234567890',
            'address' => 'Jl. 34 Fairmount Street, Smithfield,ri, 2913  United States, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam',
            'is_admin' => 1,
        ]);

        \App\Models\Category::factory(7)->create();
    }
}
