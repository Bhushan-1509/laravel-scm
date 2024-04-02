<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $i = 0;
        foreach (range(1, 40) as $index) {
            DB::table('orders')->insert([
                'order_date' => date("Y-m-d H:i:s"),
                'customer' => $faker->company(),
                'order_no' => $i + 1,
                'rate' => 12,
                'product_id' => 1,
            ]);
        }
    }
}
