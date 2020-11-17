<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecord = [
            ['id'=> '1', 'name'=> 'Arrow', 'Status' => 1],
            ['id'=> '2', 'name'=> 'Adidas', 'Status' => 1],
            ['id'=> '3', 'name'=> 'Nike', 'Status' => 1],
            ['id'=> '4', 'name'=> 'ACI', 'Status' => 1],
            ['id'=> '5', 'name'=> 'Ovanuvob', 'Status' => 1],
        ];
        Brand::insert($brandRecord);
    }
}
