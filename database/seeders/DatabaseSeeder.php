<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CategoriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // // ]);
        // $this->call([
        //     CategoriesSeeder::class,
        //     BlogsSeeder::class,
        //     ProductsSeeder::class
        // ]);

            for ($i=1; $i <= 10; $i++) {
                $item = new User();

                $item->name = "Tài khoản $i";
                $item->email = "taikhoan$i@gmail.com";
                $item->password = '$2y$12$pCTHEFoz4v74xBX0qHTP2ecdhfQXzJA0mWkMbZgyh/0fYkShOEjp2';
                $item->permission = 0;

                $item->save();
            }

    }
}
