<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => "سياسة",
            'slug' => "سياسة",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'title' => "ثقافة",
            'slug' => "ثقافة",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'title' => "إقتصاد",
            'slug' => "إقتصاد",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'title' => "فن",
            'slug' => "فن",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'title' => "تعليم",
            'slug' => "تعليم",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'title' => "تكنولوجيا",
            'slug' => "تكنولوجيا",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
