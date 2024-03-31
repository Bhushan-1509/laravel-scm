<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stage')->insert([
            'stage_name' => 'stage 1'
        ]);
        DB::table('stage')->insert([
            'stage_name' => 'stage 2'
        ]);
        DB::table('stage')->insert([
            'stage_name' => 'stage 3'
        ]);
        DB::table('stage')->insert([
            'stage_name' => 'stage 4'
        ]);
        DB::table('stage')->insert([
            'stage_name' => 'stage 5'
        ]);
    }
}
