<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rules\Captcha; 
class authController extends Controller
{
    public function getlogin()
    {
    	return view("admin.login");
    }
    public function postlogin(Request $r)
    {
       // $data = $r->validate(['g-recaptcha-response' => new Captcha(),]);
    	if(Auth::attempt(["email"=>$r->email,"password"=>$r->password]))// && $data)
    		return redirect("admin/typeProduct/list");
    	else
    		return redirect("admin")->with("thongbao","E-mail hoặc Password không chính xác");
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect("admin");
    }
}
