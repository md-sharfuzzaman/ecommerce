<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use Intervention\Image\Facades\Image;
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
        return view('admin.pages.products.product')->with(compact('products'));
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
            $productData = array();

            $message = "Product added successfully";

        }else{

            $title = "Edit Product";
            $productData = Product::find($id);
            $productData = json_decode(json_encode($productData), true);
            /* echo "<pre>"; print_r($productData); die; */
            $product= Product::find($id);
            $message = "Product Updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */

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

            // Upload product image
            if($request->hasFile('main_image')){
                $image_tmp = $request->file('main_image');
                if($image_tmp->isValid()){
                    // Upload Images after Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    $image_name = pathinfo($image_name,PATHINFO_FILENAME);
                    $extension = $image_tmp->getClientOriginalExtension();
                   /*  echo $image_name; echo"<br>"; echo $extension; die; */
                    $imageName = $image_name.'-'.rand(111,9999).'.'.$extension;
                    /* dd($imageName); */
                    $large_image_path = 'images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/product_images/small/'.$imageName;

                    Image::make($image_tmp)->save($large_image_path); // W: 1040 H: 1200
                    Image::make($image_tmp)->resize(520, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260, 300)->save($small_image_path);
                    // Save main image to products table
                    $product->main_image = $imageName;
                    
                }
            }
            // Upload Product Video
            
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    // Upload Video
                    $video_name = $video_tmp->getClientOriginalName();
                    $video_name = pathinfo($video_name,PATHINFO_FILENAME);
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = $video_name.'-'.rand().'.'.$extension;
                    $video_path = 'videos/product_videos/'.$videoName;
                    $video_tmp->move($video_path, $videoName);
                    // Save Video to products table
                    $product->product_video = $videoName;
                }
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
            session::flash('success_message', $message);
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
        return view('admin.pages.products.add_edit_product')->with(compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories', 'productData'));
    }

    // Delete product Status

    public function deleteProduct($id){
        // delete product
        Product::where('id', $id)->delete();
        $message = 'Product has been deleted successfully!';
        session::flash('success_message', $message);
        return redirect()->back();
    }


    // Product Image Delete Controller 
    public function deleteProductImage($id){
        // get Category Image
        $productImage = Product::select('main_image')->where('id', $id)->first();
        // Get Category Image path
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        // Delete small image from product image folder if exists
        if(file_exists($small_image_path.$productImage->main_image)){
            unlink($small_image_path.$productImage->main_image);
        }
        if(file_exists($medium_image_path.$productImage->main_image)){
            unlink($medium_image_path.$productImage->main_image);
        }
        if(file_exists($large_image_path.$productImage->main_image)){
            unlink($large_image_path.$productImage->main_image);
        }

        // Delete Product image Categories Table 
        Product::where('id', $id)->update(['main_image' => '']);
        return redirect()->back()->with('success_message', 'Product Image has been deleted successfully!');
    }

    // Product Video Delete Controller 
    public function deleteProductVideo($id){
        // get Category Image
        $productVideo = Product::select('product_video')->where('id', $id)->first();
        // Get Category Image path
        $product_video_path = 'videos/product_video/'.$productVideo->product_video.'/';

        // Delete Product image from product image folder if exists
        if(file_exists($product_video_path.$productVideo->product_video)){
            unlink($product_video_path.$productVideo->product_video);
        }

        // Delete Product image Categories Table 
        Product::where('id', $id)->update(['product_video' => '']);
        return redirect()->back()->with('success_message', 'Product Video has been deleted successfully!');
    }


    // Add Product Attribute

    public function addAttributes(Request $request, $id){

        if($request->isMethod('post')){
            $data = $request->all();
           /*  echo "<pre>"; print_r($data); die; */
            foreach($data['sku'] as $key => $value){
                if(!empty($value)){

                    // SKU already exists Check
                    $attributeSKU = ProductsAttribute::where(['sku'=> $value])->count();
                    if($attributeSKU > 0){
                        $message = 'SKU already exists. please another SKU';
                        Session::flash('error_message', $message);
                        return redirect()->back();
                    }

                    // Size already exists Check
                    $attributeSize = ProductsAttribute::where(['product_id'=> $id, 'size' => $data['size'][$key]])->count();
                    if($attributeSize > 0){
                        $message = 'Size already exists. please another Size';
                        Session::flash('error_message', $message);
                        return redirect()->back();
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                    

                }
            }
            $message = 'Product Attributes has been added successfully';
            Session::flash('success_message', $message);
            return redirect()->back();
        }

        $productData = Product::select('id', 'product_name', 'product_code', 'product_color', 'main_image')->with('attributes')->find($id);
        $productData = json_decode(json_encode($productData), true);
       /*  echo "<pre>"; print_r($productData); die; */
        $title = "product Attributes";
        return view('admin.pages.products.add_attributes')->with(compact('productData', 'title'));
    }

    // edit attributes
    public function editAttributes(Request $request, $id){
        if($request->isMethod('post')){

            $data = $request->all();
           /*  echo "<pre>"; print_r($data); die; */
            foreach ($data['attrId'] as $key => $attr) {
               if(!empty($attr)){
                ProductsAttribute::where(['id'=>$data['attrId'][$key]])->update(['price' => $data['price'][$key], 'stock'=>$data['stock'][$key]]);
               }
            }
            $message = 'Product Attributes has been updated successfully';
            Session::flash('success_message', $message);
            return redirect()->back();

        }
    }

    // Update status of product attribute
    public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
           /*  echo "<pre>"; print_r($data); die; */
            if($data['status']=='Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsAttribute::where('id', $data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status' => $status, 'attribute_id'=>$data['attribute_id']]);
        }
    }

    // Delete product attribute
    public function deleteAttribute($id){
        // delete product
        ProductsAttribute::where('id', $id)->delete();
        $message = 'Product Attribute has been deleted successfully!';
        session::flash('success_message', $message);
        return redirect()->back();
    }




}
