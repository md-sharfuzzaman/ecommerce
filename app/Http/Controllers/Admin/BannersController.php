<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
}
