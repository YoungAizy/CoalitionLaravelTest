<?php

namespace Database\Factories;

use App\Utils\InventoryConnector;

class ProductFactory{

    private $collection;
    private $inventory;

    private static $myInstance;

    public static function getInstance(){
        if (null === static::$myInstance) {
            static::$myInstance = new static();
            static::$myInstance->inventory = new InventoryConnector();
            static::$myInstance->collection = collect(static::$myInstance->inventory->definition());
        }
        
        return static::$myInstance;
    }

    public function getData(){
        return static::$myInstance->collection->unique('product_name');
    }

    public function save($data){
        static::$myInstance->collection->push($data);
        static::$myInstance->inventory->save(static::$myInstance->collection->toArray());
        return static::$myInstance->collection->whereStrict('product_name', $data["product_name"])->values();
        // return static::$myInstance->collection;
    }

    public function update($id, $newData){
        //find product item from inventory and update it
        $replaced = ProductFactory::getData()->keyBy('product_name')->replace([$id=>$newData]);
        static::$myInstance->inventory->save($replaced->values()->toArray());
        static::$myInstance->collection = $replaced;
        return static::$myInstance->collection->whereStrict('product_name', $newData["product_name"])->values();
    }

    
}
