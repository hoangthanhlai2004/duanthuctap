<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('blogs')->insert([
            [
                "name" => 'Hướng dẫn sử dụng',
                "slug" => 'Admin',
                "thumbnail" => '1.jpg',
                "category_id" => 'DM_01',
                "active" => true,
                "content" => '',
            ],
            [
                "name" => 'Liên Hệ',
                "slug" => 'Admin',
                "thumbnail" => '2.jpg',
                "category_id" => 'DM_02',
                "active" => true,
                "content" => '123',
            ]
            ]);
    }
}
