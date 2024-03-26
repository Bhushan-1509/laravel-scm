<?php

namespace Database\Seeders;

require 'vendor/autoload.php';

use App\Models\Product;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

use Ramsey\Uuid\Uuid;


class ProductSeeder extends Seeder
{
    private function generateChallanNumber()
    {
        $prefix = 'CHL';
        $year = date('Y');
        $department = 'ABC'; // Example department code
        $randomDigits = mt_rand(100000, 999999); // Generate a random 6-digit number

        return "{$prefix}-{$year}-{$department}-{$randomDigits}";
    }
    public function run(): void
    {
        $faker = Faker::create();
        $myfaker = \Faker\Factory::create();

        foreach (range(1, 40) as $index) {
            DB::table('products')->insert([
                'uuid' => Uuid::uuid4(),
                'company_name' => $faker->company,
                'challan_no' => $this->generateChallanNumber(),
                 'type' => $faker->bloodType(),
                 'apm_challan_no' => $this->generateChallanNumber(),
                 'size' => $faker->numberBetween(1,20),
                 'quantity' => $faker->numberBetween(1,24),
                 'for' => $faker->name,
                'cutting_size' => $faker->numberBetween(1,30),
                'cutting_weight' => $faker->numberBetween(2,10),
                'order_no' => $faker->numberBetween(1,5),
                'order_size' => $faker->numberBetween(1,30),
                'notes' => $faker->text,
            ]);
        }
    }
}
