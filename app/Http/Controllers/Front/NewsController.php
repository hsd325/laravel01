<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\News\News;
use App\Models\Admin\News\NewsType;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $req)
    {
        $news=new News();
        $date=$news->getDateList();
        $type=(new NewsType())->getList();
        $banner=(new Banner())->getBanner($req->apId);

        return view("front.news.list",compact("date","type", "banner"));

    }

    public function getNews(Request $req)
    {
        $list=(new News())->getFrontList($req->dates,$req->typeId);
        return view("front.news.news",compact("list"));
    }
    
    public function detail(Request $req)
    {
        $news=News::find($req->id);
        return view("front.news.detail",compact("news"));
    }
}
