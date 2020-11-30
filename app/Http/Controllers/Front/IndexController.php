<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $pageName = "index";


        // Get Featured Items
        $featuredItemsCount = Product::where('is_featured', 'Yes')->where('status', 1)->count();
        $featuredItems = Product::where('is_featured', 'Yes')->where('status', 1)->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);
        
        // Get latest products

        $latestProducts = Product::orderBy('id','Desc')->where('status', 1)->limit(6)->get()->toArray();
        /* dd($latestProducts); */

        return view('frontend.index')->with(compact('pageName','featuredItemsCount','featuredItemsChunk', 'latestProducts'));
    }
}
