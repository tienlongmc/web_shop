<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Message;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('admin.user.login',[
            'title'=>'Đăng nhập hệ thống'
        ]);
    }
    public function store(Request $request){
        // dump and die 
        // in ra thông tin trong input
        //dd($request->input());
        //$remember = isset($request->input('remember')) ? true : false;

        
        //trả về dữ liệu , xác thực xem email,password đúng cú pháp hay không
        $this->validate($request,[
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
        // xác thực thông tin trong data
        if (Auth::attempt([
            'email'=> $request -> input('email'),
            'password'=> $request -> input('password')
            
        ],$request->input('remember') )){
            return  redirect()->route('admin');
        }
        // loi khi nhap sai
        session()->flash('error', 'Email or Password is incorrected');


        return redirect()->back();
    }
}
