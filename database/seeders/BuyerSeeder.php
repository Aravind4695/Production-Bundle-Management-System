<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('buyers')->insert([
            ['buyer_name' => 'Nike'],
            ['buyer_name' => 'Adidas'],
            ['buyer_name' => 'Puma'],
            ['buyer_name' => 'Levi\'s'],
            ['buyer_name' => 'H&M']
        ]);
    }
}
