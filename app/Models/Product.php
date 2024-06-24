<?php

namespace App\Models;

use Jenssegers\Model\Model;
use Database\Factories\ProductFactory;

class Product extends Model
{
    //use HasFactory;

    //Attributes: product_id, product_name, product_quantity, product_price, created_at, updated_at
    protected static $unguarded = true;
    private $update_id;

    protected $fillable = [
        "product_name" => "string",
        "product_quantity" => "integer",
        "product_price" => "integer",
        "created_at" => "string",
        "updated_at" => "string",
    ];

    public function save(){
        //implement save functionality
        $this->attributes += ['created_at'=>date('Y-m-d H:i:s'), "updated_at"=> null];
        return ProductFactory::getInstance()->save($this->attributes);
    }

    public function all(){
        return ProductFactory::getInstance()->getData();
    }

    public function update(){
        $this->attributes += [
            'created_at'=>$this->all()->whereStrict('product_name', $this->update_id)->values()[0]['created_at'], 
            "updated_at"=> date('Y-m-d H:i:s')];
        return ProductFactory::getInstance()->update($this->update_id, $this->attributes);
    }

    public function setID($id){
        $this->update_id = $id;
    }

}
