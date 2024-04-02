<?php

namespace App\Http\Controllers\Visual;

use App\Charts\OrdersChart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\Http;

class VisualController extends Controller
{
    public function index(Request $request)
    {
        // Extract JSON data from the request or any other processing
        $orders = Order::all();
        $materials = Product::all();
        $suppliers = Supplier::all();
        $orderArr = json_decode($orders->toJson());
        $materialArr = json_decode($materials->toJson());
        $supplierArr = json_decode($suppliers->toJson());
        $jsonDataOrder = array(
            'orders' => $orderArr
        );

        $jsonDataMaterial = array(
            'raw_materials' => $materialArr
        );
        $jsonDataSupplier = array(
            'suppliers' => $supplierArr
        );


        $responseOrderPieChart = Http::post('http://127.0.0.1:5000/orders-pie-chart', json_encode($jsonDataOrder ));
        $responseOrderBarChart = Http::post('http://127.0.0.1:5000/orders-bar-graph', json_encode($jsonDataOrder));
        $responseMaterialPieChart = Http::post('http://127.0.0.1:5000/material-pie-chart',json_encode($jsonDataMaterial));
        $responseSupplierPieChart = Http::post('http://127.0.0.1:5000/supplier-pie-chart', json_encode($jsonDataSupplier));
        if ($responseOrderPieChart->successful() && $responseOrderBarChart->successful() && $responseMaterialPieChart->successful() && $responseSupplierPieChart->successful()) {
            $responseOrderPieChartData = $responseOrderPieChart->body();
            $responseOrderBarChartData = $responseOrderBarChart->body();
            $responseMaterialPieChartData = $responseMaterialPieChart->body();
            $responseSupplierPieChartData = $responseSupplierPieChart->body();
            return view('visual', [
                'orderPieChart' => $responseOrderPieChartData,
                'orderBarChart'=>  $responseOrderBarChartData,
                'materialPieChart' => $responseMaterialPieChartData,
                'supplierPieChart' => $responseSupplierPieChartData
            ]);
        } else {
            // Handle failed request
            return response()->json(['error' => 'Failed to send POST request'], status: 403);
        }
//        return view('visual', ['chart' => $chart]);
    }

    // Helper function to generate random colors
    private function generateRandomColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
