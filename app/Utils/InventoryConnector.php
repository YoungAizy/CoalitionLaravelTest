<?php

namespace App\Utils;

class InventoryConnector{

    protected $path = '../database/inventory.json';

    public function definition(){
        if(file_exists($this->path)){
            $file = fopen($this->path, 'r') or die("Unable to open file!");
            $data = fread($file,filesize($this->path));
            fclose($file);
            $decoded_data = json_decode($data,true);
            return $decoded_data["inventory"];
        }else{
            return $this->create();
        }
    }

    private function create($data = null){
        //Write data to Inventory.json
        $_data = $data ? $data : array();
        $inventory = array(
            "inventory"=>$_data,
        );
        $inventory_json = json_encode($inventory);
        try {
            $fp = fopen($this->path, 'w') or die("Unable to open file!");
            fwrite($fp, $inventory_json);
            fclose($fp);
            return $inventory["inventory"];
        } catch (\Throwable $th) {
            //throw $th;
            return 'An Error/Exception occured.';
        }
    }

    public function save(array $data){
        return $this->create($data);
    }

}