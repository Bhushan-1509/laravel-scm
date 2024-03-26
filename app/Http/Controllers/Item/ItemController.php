<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){

    }
    public function create(Request $request){
        return view('items.create');
    }
    public function store(){

    }
    public function show(){}
    public function edit(){}
    public function update(){}
    public function destroy(){}
}
