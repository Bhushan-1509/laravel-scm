<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

function get_random_value($array) {
    /**
     * Get a random value from an array.
     *
     * @param array $array The input array.
     * @return mixed The random value from the array.
     */
    $random_key = array_rand($array);
    return $array[$random_key];
}
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        $myfaker = \Faker\Factory::create();

        foreach (range(1, 40) as $index) {
            DB::table('customers')->insert([
                'uuid' => Uuid::uuid4(),
                'company_name' => $faker->company,
                'address' => $faker->address(),
                'pincode' => generatePincode(),
                'state' => $faker->city(),
                'gst_no' => generateGstNo(),
                'company_in_sez' => get_random_value(['yes', 'no']),
                'company_type' => get_random_value(['supplier', 'customer']),
                'distance_from_andheri' => rand(1,50),
                'distance_from_vasai' => rand(1,20),
            ]);
        }

    }
}
