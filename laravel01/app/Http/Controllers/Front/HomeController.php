<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Product\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index()
    {
        $product=(new Product())->getHomeProduct();
        $banner = (new Banner())->getBanner(0);

        return view("front.home", compact("product", "banner"));
    }

    public function lan(Request $req){}

    public function line()
    {
        $headers = array(
            "Content-Type: multipart/form-data",
            "Authorization: Bearer fgg9lKrqBgfXnt9asIc2JgmcYVgUNJq0nKgwfrENpvD" // 自己的權杖
        );

        $message = array("message" => "line通知的內容");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); // line的api
        curl_setopt($ch, CURLOPT_HEADER, $headers); // line認證
        curl_setopt($ch, CURLOPT_POST, true); // 採用POST方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message); // 送到line的訊息
        $result = curl_exec($ch); // 執行結果
        curl_close($ch);
    }

    public function crop()
    {
        return view("front.crop");
    }

    public function image()
    {
        $img = Image::make("images/product/2024_03_05_10_20_54_019.png.png");
        $img->crop(300,200);
    }
}
