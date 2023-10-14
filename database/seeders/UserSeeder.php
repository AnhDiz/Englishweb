<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name'=>'tuan','email'=>'tuan@gmail.com', 'password'=>'123456','role'=>'0'],
            ['name'=>'admin','email'=>'admin@gmail.com', 'password'=>'123456', 'role'=>'1'],
            ['name'=>'tuananh','email'=>'tuananh@gmail.com', 'password'=>'123456','role'=>'0'],
            ['name'=>'tuanttt','email'=>'tuanttt@gmail.com', 'password'=>'123456','role'=>'0'],
            ['name'=>'tuanhhhh','email'=>'tuanhhhh@gmail.com', 'password'=>'123456','role'=>'0'],

        ]);
    }
}
