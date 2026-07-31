<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SewingLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('sewing_lines')->insert([
            ['line_name' => 'Line A'],
            ['line_name' => 'Line B'],
            ['line_name' => 'Line C'],
            ['line_name' => 'Line D'],
            ['line_name' => 'Line E']
        ]);
    }
}
