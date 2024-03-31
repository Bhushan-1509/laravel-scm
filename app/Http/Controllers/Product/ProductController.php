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

    public function store(StoreProductRequest $request)
    {
        /**
         * Handle upload image
         */
        $image = "";
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image')->store('products', 'public');
        }

        Product::create([

            'product_image'     => $image,
            'name'              => $request->name,
            'category_id'       => $request->category_id,
            'unit_id'           => $request->unit_id,
            'quantity'          => $request->quantity,
            'buying_price'      => $request->buying_price,
            'selling_price'     => $request->selling_price,
            'quantity_alert'    => $request->quantity_alert,
            'tax'               => $request->tax,
            'tax_type'          => $request->tax_type,
            'notes'             => $request->notes,
            "user_id" => auth()->id(),
            "slug" => Str::slug($request->name, '-'),
            "uuid" => Uuid::uuid4()
        ]);


        return to_route('products.index')->with('success', 'Product has been created!');
    }

    public function show($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();
/*        $barcode = $generator->getBarcode($product->uuid, $generator::TYPE_CODE_128);*/
//        $qrcode = QrCode::size(300)->generateSVG($uuid);
        $qrcode = generateQrCode($uuid);
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

//        $product->update($request->except('product_image'));

//        $image = $product->product_image;
//        if ($request->hasFile('product_image')) {
//
//            // Delete Old Photo
//            if ($product->product_image) {
//                unlink(public_path('storage/') . $product->product_image);
//            }
//            $image = $request->file('product_image')->store('products', 'public');
//        }

        $product->company_name = $request->companyName;
//        $product->slug = Str::slug($request->name, '-');
        $product->challan_no = $request->challanNo;
        $product->type = $request->type;
        $product->apm_challan_no = $request->apmChallanNo;
        $product->size = $request->size;
        $product->quantity = $request->quantity;
        $product->for = $request->for;
        $product->cutting_size = $request->cuttingSize;
        $product->cutting_weight = $request->cuttingWeight;
        $product->order_no = $request->orderNo;
        $product->order_size = $request->orderSize;
        $product->notes = $request->notes;
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
