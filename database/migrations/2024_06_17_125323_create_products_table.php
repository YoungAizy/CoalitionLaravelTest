<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $inventory = array("inventory"=>array());
        $inventory_json = json_encode($inventory);
        $path = '../database/inventory.json';
        try {
            $fp = fopen($path, 'w');
            fwrite($fp, json_encode($inventory));
            fclose($fp);
        } catch (\Throwable $th) {
            //throw $th;
            return 'An Error/Exception occured.';
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
