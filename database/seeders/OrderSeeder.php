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

    private function generateRandomDateInYear($year) {
        $faker = Faker::create();

        // Set the start and end date of the specified year
        $startDate = strtotime("$year-01-01");
        $endDate = strtotime("$year-12-31");

        // Generate a random timestamp within the specified range
        $randomTimestamp = mt_rand($startDate, $endDate);
        // Convert the timestamp to a DateTime object
        $randomDate = date('Y-m-d', $randomTimestamp);

        return $randomDate;
    }


    private function giveMaterialName()
    {
        $items = array(
            "Steel",
            "Aluminum",
            "Plastic",
            "Glass",
            "Rubber",
            "Wood",
            "Copper",
            "Fabric",
        );

        $randomKey = array_rand($items);
        $randomItem = $items[$randomKey];

        return $randomItem;
    }

    private function generateProductJsonString()
    {
        $products = array();
        for ($i = 0; $i < 3; $i++) {
            $products[] = array(
                'name' => $this->giveMaterialName()
            );
        }
        return json_encode(['products' => $products]);
    }

    public function run(): void
    {
        $faker = Faker::create();
        $i = 0;
        foreach (range(1, 40) as $index) {
            $i++;
            DB::table('orders')->insert([
                'order_date' => $this->generateRandomDateInYear(2024, 10),
                'customer' => $faker->company(),
                'order_no' => $i,
                'rate' => 12,
                'products' => $this->generateProductJsonString()
            ]);
        }
    }
}

