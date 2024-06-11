<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\About\About;
use App\Models\Admin\About\AboutAdvance;
use App\Models\Admin\About\AboutContent;
use App\Models\Admin\About\AboutNote;
use App\Models\Admin\Banner;
use App\Models\Admin\Label;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $req)
    {
        $banner=(new Banner())->getBanner($req->apId);
        $note=(new AboutNote())->getList();
        $advance=(new AboutAdvance())->getList();
        $about=(new Label())->getLabel("關於");
        $ad=(new Label())->getLabel("優勢");
        $line=(new Label())->getLabel("記事");
        $home=(new Label())->getLabel("首頁");
        $us=(new About())->getList();
        $content=(new AboutContent())->getList();

        return view("front.about", compact("banner", "note", "advance", "about", "ad", "line", "home", "us", "content"));
    }

    public function saveImg()
    {
        if(!file_exists("images/about/img"))
        {
            mkdir("images/about/img", 0777);
        }

        $data = $_REQUEST["data"];
        $image = explode("base64", $data);
        date_default_timezone_get("Asia/Taipei");

        // date('YmdHis') : 當前日期和時間的意思
        file_put_contents("images/about/img/test_".date('YmdHis').".png", base64_decode($image[1]));
    }
}
