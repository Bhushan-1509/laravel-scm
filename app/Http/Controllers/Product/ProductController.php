<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Str;
use function Laravel\Prompts\error;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->count();
        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::where("user_id", auth()->id())->get(['id', 'name']);
        $units = Unit::where("user_id", auth()->id())->get(['id', 'name']);

        if ($request->has('category')) {
            $categories = Category::where("user_id", auth()->id())->whereSlug($request->get('category'))->get();
        }

        if ($request->has('unit')) {
            $units = Unit::where("user_id", auth()->id())->whereSlug($request->get('unit'))->get();
        }

        return view('products.create', [
            'categories' => $categories,
            'units' => $units,
        ]);
    }

    public function store(Request $request)
    {
        Product::create([
            'uuid' => Uuid::uuid4(),
                'material_name' => $request->materialName,
                'company_name' => $request->companyName,
            'challan_no' => $request->challanNo,
            'apm_challan_no' => $request->apmChallanNo,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'for' => $request->for,
            'cutting_size' => $request->cuttingSize,
            'cutting_weight' => $request->cuttingWeight,
            'order_no' => $request->orderNo,
            'order_size' => $request->orderSize,
            'notes' => $request->notes,
            'stage' => $request->stage
        ]);


        return to_route('products.index')->with('success', 'Material has been created!');
    }

    public function show($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();
        $ipconfigOutput = shell_exec('ipconfig');
//        dd($ipconfigOutput);
        $pattern = '/Wireless LAN adapter.*?(IPv4 Address.*?:\s*([0-9.]+))/s';
        $uri = null;
        if (preg_match($pattern, $ipconfigOutput, $matches)) {
            $ipAddress = $matches[2];
            $uri = "http://" . $ipAddress . ":8000/track?uuid=" . $uuid;
        }
        $qrcode = generateQrCode($uri);
//        dd($qrcode);

        return view('products.show', [
            'product' => $product,
            'qrcode' => $qrcode,
        ]);
    }

    public function edit($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, $uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();


        $product->company_name = $request->companyName;
//        $product->slug = Str::slug($request->name, '-');
        $product->challan_no = $request->challanNo;
        $product->apm_challan_no = $request->apmChallanNo;
        $product->size = $request->size;
        $product->quantity = $request->quantity;
        $product->for = $request->for;
        $product->cutting_size = $request->cuttingSize;
        $product->cutting_weight = $request->cuttingWeight;
        $product->order_no = $request->orderNo;
        $product->order_size = $request->orderSize;
        $product->notes = $request->notes;
        $product->stage = $request->stage;
        $result = $product->save();

        if(!$result){
            return redirect()
                ->route('products.index')
                ->with('danger', 'Unable to update!');
        }
        return redirect()
            ->route('products.index')
            ->with('success', 'Material has been updated!');
    }

    public function destroy($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        /**
         * Delete photo if exists.
         */

        $result = $product->delete();
        if(!$result){
            return redirect()
                ->route('products.index')
                ->with('danger', 'Unable to delete raw material!');
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Raw material has been deleted!');
    }

}
