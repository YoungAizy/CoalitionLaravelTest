<?php

namespace App\Repository;

use App\Repository\Interfaces\ProductInterface;
use App\Utils\InventoryConnector;
use App\Models\Product;

class ProductRepository implements ProductInterface{
    protected $model;

    public function __construct(Product $model){
        $this->model = $model;
    }

    public function all(){
        return Product::all();
    }

    public function save(){
        return $this->model->save();
    }

    public function update($id){
        $this->model->setID($id);
        return $this->model->update();
    }
}