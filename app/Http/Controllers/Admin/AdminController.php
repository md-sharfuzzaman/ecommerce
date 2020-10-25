<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //Create dashboard function

    public function dashboard(){
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
        //$adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u', 
                'admin_mobile' => 'required|numeric', 
                
            ];
            $customMessage = [
                'admin_name.required' => 'Name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Only number is valid',
            ];

            $this->validate($request, $rules, $customMessage);

            // update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name' =>$data['admin_name'], 'mobile'=>$data['admin_mobile']]);

            session::flash('success_message', 'Admin details updated successfully!');
            return redirect()->back();
        } 

        return view('admin.pages.admin_details');
    }

}
