<?php

namespace App\Http\Controllers\Product;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Str;


class ProductImportController extends Controller
{
    public function create()
    {
        return view('products.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $the_file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $row_range    = range(2, $row_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {
                $data[] = [
                    'company_name'          => $sheet->getCell('A' . $row)->getValue(),
                    'challan_no'          => $sheet->getCell('B' . $row)->getValue(),
                    'type'   => $sheet->getCell('C' . $row)->getValue(),
                    'apm_challan_no'       => $sheet->getCell('D' . $row)->getValue(),
                    'size'          => $sheet->getCell('E' . $row)->getValue(),
                    'quantity'      => $sheet->getCell('F' . $row)->getValue(),
                    "for" => $sheet->getCell('G' . $row)->getValue(),
                    'cutting_size'  => $sheet->getCell('H' . $row)->getValue(),
                    'cutting_weight' => $sheet->getCell('I' . $row)->getValue(),
                    'order_no' => $sheet->getCell('J' . $row)->getValue(),
                    'order_size' => $sheet->getCell('K' . $row)->getValue(),
                    'notes' => $sheet->getCell('L' . $row)->getValue(),
                ];
                $startcount++;
            }

            foreach ($data as $product) {
                Product::firstOrCreate([
                    'uuid'=> \Ramsey\Uuid\Nonstandard\Uuid::uuid4(),
                    'company_name' => $product['company_name'],
                    'challan_no' => $product['challan_no'],
                    'type'   => $product['type'],
                    'apm_challan_no'  => $product['apm_challan_no'],
                    'size'          => $product['size'],
                    'quantity'      => $product['quantity'],
                    "for" => $product['for'],
                    'cutting_size'  => $product['cutting_size'],
                    'cutting_weight' => $product['cutting_weight'],
                    'order_no' => $product['order_no'],
                    'order_size' => $product['order_size'],
                    'notes' => $product['notes'],
                ], $product);
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return redirect()
                ->route('products.index')
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Data product has been imported!');
    }
}
