<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products(){
        Session::put('page', 'products');
        $products = Product::with([
            'category' => function($query){
                $query->select('id', 'category_name');
            },
            'section' => function($query){
                $query->select('id', 'name');
            }
        ])->get();
        /* $products = json_decode(json_encode($products));
        echo "<pre>"; print_r($products); die; */
        return view('admin.pages.products.index')->with(compact('products'));
    }

    // Update Product Status
    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if($data['status']=='Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status' => $status, 'product_id'=>$data['product_id']]);
        }
    }

    // Add Product

    public function addEditProduct(Request $request, $id=null){
        if($id == ""){
            $title = "Add Product";
        }else{
            $title = "Edit Product";
        }

        // Filter Arrays
        $fabricArray = array('Cotton', 'Polyester', 'Wool');
        $sleeveArray = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $fitArray = array('Regular', 'Slim');
        $occasionArray = array('Casual', 'Formal');

        // Section with Categories and Sub Categories

        $categories = Section::with('categories')->get();

        /* $categories = json_decode(json_encode($categories), true);

        echo "<pre>"; print_r($categories); die; */

        return view('admin.pages.products.add_edit_product')->with(compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories'));
    }

    // Delete product Status

    public function deleteProduct($id){
        // delete product
        Product::where('id', $id)->delete();
        $message = 'Product has been deleted successfully!';
        session::flash('success_message', $message);
        return redirect()->back();
    }
}
