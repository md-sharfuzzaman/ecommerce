<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
class AdminController extends Controller
{
    //Create dashboard function

    public function dashboard(){
        Session::put('page', 'dashboard');
        return view('admin.pages.dashboard');
    }

    // Create Log in function

    public function login(Request $request){
        //echo $password = Hash::make('123456'); die;
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data); die;

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessage = [
                'email.required' => 'Email address is required',
                'email.email' => 'Valid Email is required',
                'email.max' => 'Max 255 Character allowed',
                'password.required' => 'Password is required'
            ];

            $this->validate($request, $rules, $customMessage);

           if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){
            return redirect('admin/dashboard');
           }else{
               Session::flash('error_message', 'Invalid Email or Password');
               return redirect()->back();
           }
        }
        return view('admin.pages.login');
    }

    // log out admin from dashboard
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    // admin settings function
    public function settings(){
        Session::put('page', 'settings');
        /* echo "<pre>";print_r(Auth::guard('admin')->user()); die; */
       $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
       
        return view('admin.pages.settings')->with(compact('adminDetails'));
    }

    // check current password
    public function chkCurrentPassword(Request $request){
        $data = $request->all();
        /* echo "<pre>"; print_r($data); die; */
        /* echo "<pre>"; print_r(Auth::guard('admin')->user()->password); die; */

        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }

    // update current password
    public function updateCurrentPassword(Request $request){
       
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            // Check if current password is correct
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){

                // Check if new and confirm password is matching
                if($data['new_pwd']===$data['confirm_pwd']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success_message', 'Password has been updated successfully');
                }else{
                    Session::flash('error_message', 'New password is not match with confirm password');
                    //return redirect()->back();
                }

            }else{
                Session::flash('error_message', 'Your current password is incorrect');
                return redirect()->back();
            }

            return redirect()->back();
        }
    }

    // Update Admin details
    public function updateAdminDetails(Request $request){
        Session::put('page', 'update-admin-details');
        //$adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u', 
                'admin_mobile' => 'required|numeric', 
                'admin_image' => 'image', 
                
            ];
            $customMessage = [
                'admin_name.required' => 'Name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Only number is valid',
                'admin_image.image' => 'Only image is valid',
            ];

            $this->validate($request, $rules, $customMessage);

            // upload image
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    // get image extension

                    $extension= $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName= rand(111, 99999).'.'.$extension;
                    $imagePath = 'backend/img/admin_photos'.$imageName;
                    // upload the image

                    Image::make($image_tmp)->resize(300, 400)->save($imagePath);
                    
                }else if(!empty($data['current_admin_image'])){
                    $imageName = $data['current_admin_image'];
                }else{
                    $imageName = "";
                }
            }

            // update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name' =>$data['admin_name'], 'mobile'=>$data['admin_mobile'], 'image'=>$imageName]);

            session::flash('success_message', 'Admin details updated successfully!');
            return redirect()->back();
        } 

        return view('admin.pages.admin_details');
    }

}
