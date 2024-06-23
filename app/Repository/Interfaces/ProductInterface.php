<?php

namespace App\Repository\Interfaces;

interface ProductInterface
{
    public function all();

    public function update($id);

    public function save();
}