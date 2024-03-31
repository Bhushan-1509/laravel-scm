<?php

namespace Database\Seeders;
require 'vendor/autoload.php';

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Faker\Factory as Faker;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 40) as $index) {
            $array  = array('Tier 1', 'Tier 2', 'Tier 3');
            shuffle($array);
            DB::table('suppliers')->insert([
                'uuid' => Uuid::uuid4(),
                'name' => $faker->name,
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address(),
                'shopname' => $faker->company,
                'type' => $array[0],
                'account_holder' => $faker->firstName . " " . $faker->lastName(),
                'account_number' => generateAccountNumber(),
                'ifsc' => getRandomIndianBank()
            ]);
        }

    }
}
