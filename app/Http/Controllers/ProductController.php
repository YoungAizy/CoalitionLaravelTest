<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repository\ProductRepository;

class ProductController extends Controller
{
    //save products and retrieve them.
    public function save(ProductRequest $request){
        // create a product model and connect to repository
        $validated = $request->safe()->only('data');
        $product = new Product($validated['data']);
        $repo = new ProductRepository($product);
        return $repo->save();
    }

    public function fetchAll(){
        //return Inventory.json
        $inventory = ProductRepository::all();
        $tableView = view('components.product-table', ['products'=>$inventory])->render();
        return response()->json(['success'=>true,'table_view'=>$tableView]);
    }

    public function update(UpdateProductRequest $request){
        $validated = $request->safe()->only('data');
        $product = new Product($validated['data']);
        $repo = new ProductRepository($product);
        return $repo->update(($request->safe()->only('id'))['id']);
    }
}
