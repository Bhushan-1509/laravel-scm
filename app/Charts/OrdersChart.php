<?php

namespace App\Charts;

use App\Models\Order;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Faker\Factory as Faker;
class OrdersChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $faker = Faker::create();

        $startDate = '2024-01-01'; // Adjust as needed
        $endDate = '2024-06-31'; // Adjust as needed
        $numberOfOrders = 100; // Adjust as needed

        $orders = [];
        for ($i = 0; $i < $numberOfOrders; $i++) {
            $orders[] = new Order([
                'order_date' => $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
                'customer' => $faker->company(),
                'order_no' => $i + 1,
                'rate' => 12,
                'product_id' => 1,
            ]);
        }

        $this->labels(['January', 'February', 'March']); // Adjust as needed
        $this->dataset('Orders by Month', 'line', collect($orders)->groupBy(function ($order) {
            return date('F', strtotime($order->order_date));
        })->map(function ($group) {
            return $group->count();
        })->values()->toArray());
    }

    public function render() // Added method
    {
        return $this->toJson(); // Default rendering using JSON
    }

    /**
     * Set the chart labels.
     *
     * @param  array  $labels
     * @return $this
     */
    public function setLabels(array $labels)
    {
        $this->labels($labels);

        return $this;
    }

    // Add more methods to customize the chart as needed...
}
