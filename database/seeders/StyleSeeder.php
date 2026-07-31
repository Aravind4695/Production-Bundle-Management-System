<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('styles')->insert([
            [
                'buyer_id' => 1,
                'style_no' => 'NK-1001'
            ],
            [
                'buyer_id' => 1,
                'style_no' => 'NK-1002'
            ],
            [
                'buyer_id' => 2,
                'style_no' => 'AD-2001'
            ],
            [
                'buyer_id' => 3,
                'style_no' => 'PM-3001'
            ],
            [
                'buyer_id' => 4,
                'style_no' => 'LV-4001'
            ]
        ]);
    
    }
}
