<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
    public function categories(){
        Session::put('page', 'categories');
        $categories = Category::get();
       /*  $categories = json_decode(json_encode($categories));
        echo "<pre>"; print_r($categories); die; */
        return view('admin.pages.category.categories')->with(compact('categories'));
    }

    // update category status
    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if($data['status']=='Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status'=>$status]);
            return response()->json(['status' => $status, 'category_id'=>$data['category_id']]);
        }
    }

    // add edit category

    public function addEditCategory(Request $request, $id=null){
        if($id==""){
            $title = "Add Category";
            // Add Category Functionality
            $category = new Category;
        }else{
            // Add Category Functionality
            $title = "Edit Category";
        }

        // get form data

        if($request->isMethod('post')){
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */

            // Category Validation
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'category_url' => 'required',
                'category_image' => 'image',
               
            ];

            $customMessage = [
                'category_name.required' => 'Name is required',
                'category_name.regex' => 'Valid Name is required',
                'section_id.required' => 'Section is required',
                'category_image.image' => 'Valid image is required',
                'url.required' => 'URL is required',
               
            ];
            $this->validate($request, $rules, $customMessage);

            if(empty($data['description'])){
                $data['category_description']="";
            }
            if(empty($data['meta_title'])){
                $data['meta_title']="";
            }
            if(empty($data['meta_description'])){
                $data['meta_description']="";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords']="";
            }
            if(empty($data['category_discount'])){
                $data['category_discount']="";
            }
            
            // upload category image
            if($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    // get image extension

                    $extension= $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName= rand(111, 99999).'.'.$extension;
                    $imagePath = 'images/category_image'.$imageName;
                    // upload the image

                    Image::make($image_tmp)->save($imagePath);
                    // save category image
                    $category->category_image = $imageName;
                    
                }
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id  = $data['section_id'];
            $category->category_name   = $data['category_name'];
            $category->category_discount   = $data['category_discount'];
            $category->description   = $data['category_description'];
            $category->url   = $data['category_url'];
            $category->meta_title   = $data['meta_title'];
            $category->meta_description   = $data['meta_description'];
            $category->meta_keywords   = $data['meta_keywords'];
            $category->status   = 1;
            $category->save();
            
            Session::flash('success_message', 'Category added successfully');
            return redirect('admin/categories');
        }

        // Get all section

        $getSections = Section::get();

        return view('admin.pages.category.add_edit_category')->with(compact('title', 'getSections'));
    }
}
 