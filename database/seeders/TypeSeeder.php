<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            ['name'=>'danh từ','date'=>'2023-10-12'],
            ['name'=>'động từ','date'=>'2023-10-12'],
            ['name'=>'phó từ','date'=>'2023-10-12'],
            ['name'=>'tính từ','date'=>'2023-10-12'],
            ['name'=>'đại từ','date'=>'2023-10-12'],
            ['name'=>'liên từ','date'=>'2023-10-12'],
            ['name'=>'giới từ','date'=>'2023-10-12'],
            ['name'=>'thán từ','date'=>'2023-10-12'],
            ['name'=>'viết tắt','date'=>'2023-10-12'],
        ]);
    }
}
