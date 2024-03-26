<?php

namespace App\Providers;

use Faker\Provider\Base;

class ChallanNumberProvider extends Base
{
    /**
     * Generate a fake challan number.
     *
     * @return string
     */
    public function challanNumber()
    {
        // Customize the format of the challan number as needed
        $prefix = 'CHL';
        $year = date('Y');
        $department = $this->generator->randomElement(['ABC', 'DEF', 'GHI']); // Example department codes
        $randomDigits = $this->generator->randomNumber(6);

        return sprintf('%s-%s-%s-%06d', $prefix, $year, $department, $randomDigits);
    }
}
