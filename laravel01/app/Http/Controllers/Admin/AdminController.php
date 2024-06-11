<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Counter;
use App\Models\Admin\Manager\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.login");
    }

    public function login(Request $req)
    {
        $rules =[
            "userId" => "required",
            "pwd" => "required",
            "code" => "required|captcha"
        ];

        $message = [
            "userId.required" => "請輸入帳號",
            "pwd.required" => "請輸入密碼",
            "code.required" => "請輸入驗證碼",
            "code.captcha" => "驗證碼錯誤",
        ];

        $validator = Validator::make(request()->all(), $rules, $message);
        if($validator->fails())
        {
            return redirect("/admin")->withInput()->withErrors($validator);
            exit;
        }

        $manager=(new Manager())->getManager($req->userId, $req->pwd);
        if(empty($manager))
        {
            return back()->withInput()->withErrors("msg","帳號或密碼錯誤");
        }else{
            session()->put("managerId", $req->userId);
            return redirect("/admin/home");
        }
    }

    public function home()
    {
        // echo("登入成功");
        $counter=(new Counter())->getCounter(); 
        return view("admin.home1", compact("counter"));
    }

    public function logout()
    {
        Session::forget("managerId");
        return redirect("/admin/home");
    }
}
