<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BannersController extends Controller
{
    public function banners(){
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        /* dd($banners); */

        return view('admin.pages.banners.banner')->with(compact('banners'));
    }


    // update banner status
    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
           /*  echo "<pre>"; print_r($data); die; */
            if($data['status']=='Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status' => $status, 'banner_id'=>$data['banner_id']]);
        }
    }

    // delete banner
    public function deleteBanner($id){
        // get banner images
        $bannerImage = Banner::where('id', $id)->first();
        // get banner image path
        $banner_image_path = 'images/banner_images/';
        // if exists banner image then delete banner image from folder
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }
        // Delete Banner from banner table
        Banner::where('id', $id)->delete();
        $message = 'Banner has been deleted successfully!';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    // add edit banner

    public function addEditBanner($id = null, Request $request){
        if($id == ""){
            // add banner
            $title = "Add Banner Image";
            $banner = new Banner;
            $message = "Banner added successfully";
        }else{
            $banner = Banner::find($id);
            $title = "Edit Banner Image";
            $message = "Banner updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
           /*  dd($data); */
            
            $banner->title = $data['banner_title'];
            $banner->link = $data['banner_link'];
            $banner->alt = $data['banner_alt'];

            // upload Banner image
            if($request->hasFile('banner_image')){
                $image_tmp = $request->file('banner_image');
                if($image_tmp->isValid()){
                    // get image extension

                    $extension= $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName= rand(111, 99999).'.'.$extension;
                    $imagePath = 'images/banner_images/'.$imageName;
                    // upload the image

                    Image::make($image_tmp)->resize(1170, 480)->save($imagePath);
                    // save Banner image
                    $banner->image = $imageName;
                    
                }
            }
            $banner->save();
            session::flash('success_message', $message);
            return redirect('admin/banners');
        }

        return view('admin.pages.banners.add-edit-banner')->with(compact('title', 'banner'));
    }
}
