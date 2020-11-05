<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products(){
        $products = Product::get();
        $products = json_decode(json_encode($products));

        echo "<pre>"; print_r($products); die;
    }
}
