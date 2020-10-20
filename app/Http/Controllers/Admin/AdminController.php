<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.pages.settings');
    }

}
