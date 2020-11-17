<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function brands(){
        Session::put('page', 'brands');
        $brands = Brand::get();
       /*  dd($brands); */
        return view('admin.pages.brand.brand')->with(compact('brands'));
    }

    // update Brand status
    public function updateBrandStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if($data['status']=='Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status' => $status, 'brand_id'=>$data['brand_id']]);
        }
    }

    // Add Edit brand

    public function addEditBrand(Request $request, $id=null){
        
        if($id == ""){
            $title = 'Add Brand';
            $brand = new Brand;
            $brandData = array();
            $message = "Brand Added successfully";
        }else{
            $title = "Edit Brand";
            $brandData= Brand::where('id', $id)->first();
           /*  dd($brandData); */
            $brand = Brand::find($id);
            $message = "Brand Updated Successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            /* dd($data); */
            // Brand Validation
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
               
            ];
            $customMessage = [
                'brand_name.required' => 'Brand Name is required',
                'brand_name.regex' => 'Valid Brand Name is required',
        
            ];
            $this->validate($request, $rules, $customMessage);

            $brand->name = $data['brand_name'];
            $brand->save();

            Session::flash('success_message', $message);

        }

        return view('admin.pages.brand.add-edit-brand')->with(compact('title', 'brand'));
    }

    // Delete Brand 
    public function deleteBrand($id){
        // delete category
        Brand::where('id', $id)->delete();
        $message = 'Brand has been deleted successfully!';
        Session::flash('success_message', $message);
        return redirect()->back();
    }

}
 



 