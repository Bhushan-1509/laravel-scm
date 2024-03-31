<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\ProductController;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Ramsey\Uuid\Nonstandard\Uuid;

class ItemController extends Controller
{
    public function index(){
        $items = Item::all()->count();
        return view('items.index', ['items' => $items]);
    }
    public function create(Request $request){
        return view('items.create');
    }
    public function store(Request $request){
       $request->validate([
           'productImage' => 'required|image|mimes:jpeg,jpg,png|max:2048',
           'productName' => 'required|string',
           'rodDiameter' => 'required|numeric',
           'unitWeight' => 'required|numeric',
           'unitPrice' => 'required|numeric',
           'quantity' => 'required|numeric',
           'total' => 'required|numeric'
       ]);

       $product = new Item;
       $product->item_name = $request->input('productName');
       $product->rod_diameter = $request->input('rodDiameter');
       $product->unit_weight = $request->input('unitWeight');
       $product->unit_price = $request->input('unitPrice');
       $product->quantity = $request->input('quantity');
       $product->total = $request->input('total');
       $product->uuid = Uuid::uuid4();



       if($product->save()){
           return to_route('items.index')->with('success', 'Product has been created!');
       }
       else{
           return to_route('items.index')->with('danger', 'Unable to add product!');
       }

    }
    public function show($uuid){
        $product = Item::where('uuid', $uuid)->firstOrFail();
        return view('items.show', ['product' => $product]);
    }
    public function edit($uuid){
        $product = Item::where("uuid", $uuid)->firstOrFail();
        return view('items.edit', [
            'product' => $product
        ]);
    }
    public function update(){}
    public function destroy($uuid){
        $product = Item::where("uuid", $uuid)->firstOrFail();
        /**
         * Delete photo if exists.
         */

        $result = $product->delete();
        if(!$result){
            return redirect()
                ->route('items.index')
                ->with('danger', 'Unable to delete product!');
        }

        return redirect()
            ->route('items.index')
            ->with('success', 'Product has been deleted!');
    }
}
