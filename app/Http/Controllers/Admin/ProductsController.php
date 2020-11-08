<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
       /*  $products = json_decode(json_encode($products));
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

            $product = new Product;


        }else{
            $title = "Edit Product";
        }

        if($request->isMethod('post')){
            $data = $request->all();
           /*  echo "<pre>"; print_r($data); die; */

            // Product Validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price'=> 'required|numeric',
               
            ];

            $customMessage = [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Product Name is required',
                'product_name.regex' => 'Valid Product Name is required',
                'product_code.required' => 'Product Code is required',
                'product_code.regex' => 'Valid Product Code is required',
                'product_price.required'=> 'Product Price is required',
                'product_price.numeric' => 'Valid Product price is required'
               
            ];
            $this->validate($request, $rules, $customMessage);
            
            if(empty($data['is_featured'])){
                $is_featured = "No";
            }else{
                $is_featured = "Yes";
            }


          
            if(empty($data['product_discount'])){
                $data['product_discount'] = 0;
            }
            if(empty($data['product_weight'])){
                $data['product_weight'] = 0;
            }
            if(empty($data['description'])){
                $data['description'] = "";
            }
            if(empty($data['wash_care'])){
                $data['wash_care']= "";
            }
            if(empty($data['fabric'])){
                $data['fabric']= "";
            }
            if(empty($data['pattern'])){
                $data['pattern']= "";
            }
            if(empty($data['fit'])){
                $data['fit']= "";
            }
            if(empty($data['sleeve'])){
                $data['sleeve']= "";
            }
            if(empty($data['occasion'])){
                $data['occasion']= "";
            }
            if(empty($data['meta_title'])){
                $data['meta_title']= "";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords']= "";
            }
            if(empty($data['meta_description'])){
                $data['meta_description']= "";
            }
            if(empty($data['main_image'])){
                $data['main_image'] = "image.jpg";
            }
            if(empty($data['product_video'])){
                $data['product_video'] = "video.mp4";
            }

            // Save product details in products table 
            $categoryDetails = Category::find($data['category_id']);
            /*echo"<pre>"; print_r($categoryDetails); die;*/
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->main_image = $data['main_image'];
            $product->product_video = $data['product_video'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->fit = $data['fit'];
            $product->sleeve = $data['sleeve'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->meta_description = $data['meta_description'];
            $product->is_featured = $is_featured;
            $product->status = 1;
            $product->save();
            session::flash('success_message', 'Product added successfully');
            return redirect('admin/products');
           
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
        return view('admin.pages.products.add_edit_product')->with(compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories',));
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
