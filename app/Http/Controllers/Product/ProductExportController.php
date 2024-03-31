<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ProductExportController extends Controller
{
    public function create()
    {
        $products = Product::all()->sortBy('product_name');

        $product_array[] = array(
            'Company Name',
            'Challan No',
            'Type',
            'APM Challan No',
            'Size',
            'Quantity',
            "for",
            'Cutting Size',
            'Cutting Weight',
            'Order No',
            'Order Size',
            "Notes"
        );


        foreach ($products as $product) {
            $product_array[] = array(
                'Company Name' => $product->company_name,
                'Challan No' => $product->challan_no,
                'Type' => $product->type,
                'APM Challan No' => $product->apm_challan_no,
                'Size' => $product->size,
                'quantity' => $product->quantity,
                "for" => $product->for,
                'Cutting Size' => $product->cutting_size,
                'Cutting Weight' => $product->cutting_weight,
                'Order No' => $product->order_no,
                'Order Size' => $product->order_size,
                "Notes" => $product->notes
            );
        }
//        dd($product_array);
        $this->store($product_array);
    }

    public function store($products)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($products);
            $Excel_writer = new Xls($spreadSheet);
            $csv_writer = new Csv($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="products.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
