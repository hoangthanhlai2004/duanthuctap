<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                "name" => 'Sung',
                "slug" => 'sung',
                "active" => true,
            ],
            [
                "name" => 'Dao nhọn',
                "slug" => 'dao_nhon',
                "active" => true,
            ]
            ]);
    }
}
