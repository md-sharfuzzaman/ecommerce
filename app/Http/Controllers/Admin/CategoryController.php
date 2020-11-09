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
        $categories = Category::with(['section', 'parentCategory'])->get();
        $categories = json_decode(json_encode($categories));
       /*  echo "<pre>"; print_r($categories); die; */
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
            $categoryData = array();
            $getCategories = array();
            $message = "Category Added Successfully!";
        }else{
            // Add Category Functionality
            $title = "Edit Category";
            $categoryData= Category::where('id', $id)->first();
           /*  $categoryData = json_decode(json_encode($categoryData), true);
            echo "<pre>"; print_r($categoryData); die; */
            $getCategories = Category::with('subcategories')->where(['parent_id'=> 0, 'section_id'=> $categoryData['section_id']])->get();
           /*  $getCategories = json_decode(json_encode($getCategories), true); */
            /* echo "<pre>"; print_r($getCategories); die; */
            $category = Category::find($id);
            $message = "Category Update Successfully!";
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
                $data['description']="";
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
                $data['category_discount']=0;
            }
            
            // upload category image
            if($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    // get image extension

                    $extension= $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName= rand(111, 99999).'.'.$extension;
                    $imagePath = 'images/category_image/'.$imageName;
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
            $category->description   = $data['description'];
            $category->url   = $data['category_url'];
            $category->meta_title   = $data['meta_title'];
            $category->meta_description   = $data['meta_description'];
            $category->meta_keywords   = $data['meta_keywords'];
            $category->status   = 1;
            $category->save();
            
            Session::flash('success_message', $message);
            return redirect('admin/categories');
        }

        // Get all section

        $getSections = Section::get();

        return view('admin.pages.category.add_edit_category')->with(compact('title', 'getSections', 'categoryData', 'getCategories'));
    }

    public function appendCategoryLevel(Request $request){
        if($request->ajax()){
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */
            $getCategories = Category::with('subcategories')->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1])->get();

            $getCategories = json_decode(json_encode($getCategories),true);
            /* echo "<pre>"; print_r($getCategories); die; */

            return view('admin.pages.category.append_categories_level')->with(compact('getCategories'));
        }
    }

    // Category Image Delete Controller 
    public function deleteCategoryImage($id){
        // get Category Image
        $categoryImage = Category::select('category_image')->where('id', $id)->first();
        // Get Category Image path
        $category_image_path = 'images/category_image/';

        // Delete Category image from category_images folder if exists
        if(file_exists($category_image_path.$categoryImage->category_image)){
            unlink($category_image_path.$categoryImage->category_image);
        }

        // Delete Category image Categories Table 
        Category::where('id', $id)->update(['category_image' => '']);
        return redirect()->back()->with('success_message', 'Category Image has been deleted successfully!');
    }

    // delete category
    public function deleteCategory($id){
        // delete category
        Category::where('id', $id)->delete();
        $message = 'Category has been deleted successfully!';
        session::flash('success_message', $message);
        return redirect()->back();
    }
}
 