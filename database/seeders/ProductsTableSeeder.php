<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id'=> 1, 'category_id'=>2, 'section_id'=> 1, 'product_name'=>'blue t-shirt', 'product_code'=>'BT001', 'product_color'=>'Blue', 'product_price'=> 200, 'product_discount'=>10, 'product_weight'=>185, 'product_video'=> "", 'main_image'=>"", 'description'=> 'নীলকুঠিদের নীল রঙের টি শার্ট। একেবারে খাঁটি ব্রিটিশদের প্রোডাক্ট।', 'wash_care'=>"জানিনা আমি", 'fabric'=> 'এক্কেরে অরিজিনাল সুতি', 'pattern'=> "", 'sleeve'=>'full sleeve', 'fit'=>'tight fit', 'occasion'=> "", 'meta_title'=>"গেঞ্জি মিয়া", 'meta_description'=> "", 'meta_keywords'=> "সুতির গেঞ্জি", 'is_featured'=> "Yes", "status"=> 1], 
            ['id'=> 2, 'category_id'=>1, 'section_id'=> 1, 'product_name'=>'casual t-shirt', 'product_code'=>'BT002', 'product_color'=>'White', 'product_price'=>500, 'product_discount'=>10, 'product_weight'=>200, 'product_video'=> "", 'main_image'=>"", 'description'=> 'নীলকুঠিদের নীল রঙের টি শার্ট। একেবারে খাঁটি ব্রিটিশদের প্রোডাক্ট।', 'wash_care'=>"জানিনা আমি", 'fabric'=> 'এক্কেরে অরিজিনাল সুতি', 'pattern'=> "", 'sleeve'=>'full sleeve', 'fit'=>'tight fit', 'occasion'=> "", 'meta_title'=>"গেঞ্জি মিয়া", 'meta_description'=> "", 'meta_keywords'=> "সুতির গেঞ্জি", 'is_featured'=> "Yes", "status"=> 1],
        ];

        Product::insert($productRecords);
    }
}
