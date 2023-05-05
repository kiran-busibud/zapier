<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProductRepository
{
    function getAllProducts()
    {
        $params = [];
        
        $query = "SELECT id, name, userid
                FROM products
                WHERE userid NOT NULL";

        $products = DB::select($query,$params);

        return $products;
    }

    function getProductsByUserId($userId)
    {
        $params = [];
        
        $query = "SELECT id, name, userid
                FROM products
                WHERE userid = $userId";

        $products = DB::select($query,$params);

        return $products;
    }
}