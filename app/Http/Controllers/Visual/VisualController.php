<?php

namespace App\Http\Controllers\Visual;

use App\Charts\OrdersChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;

class VisualController extends Controller
{
    public function index(Request $request)
    {
//        // Retrieve data from the Order model
//        $orders = Order::selectRaw('product_id, order_date, SUM(rate) as total_sales')
//            ->groupBy('product_id', 'order_date')
//            ->get();
//
//        // Format the data for the chart
//        $chartData = [];
//        foreach ($orders as $order) {
//            $orderDate = Carbon::parse($order->order_date); // Parse the string into a DateTime object
//            $formattedDate = $orderDate->format('Y-m'); // Format the date
//            $chartData[$order->product_id][$formattedDate] = $order->total_sales;
//        }
//
//        // Create the chart
//        $chart = Charts::multi('line', 'highcharts')
//            ->title('Total Sales per Product over Time')
//            ->dimensions(1000, 500)
//            ->responsive(false);
//
//        // Add dataset for each product
//        foreach ($chartData as $productId => $salesData) {
//            $chart->dataset("Product $productId", 'line', array_values($salesData))
//                ->color($this->generateRandomColor());
//        }
//
//        return view('charts.index', compact('chart'));
        $chart = new OrdersChart();

        return view('visual', ['chart' => $chart]);
    }

    // Helper function to generate random colors
    private function generateRandomColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
