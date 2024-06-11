<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\Admin\News\News;
use App\Models\Admin\News\NewsType;
use App\Models\Admin\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function list()
    {
        $list=(new News())->getList();
        return view("admin.news.list",compact("list"));
    }

    public function add()
    {
        $list=(new NewsType())->getList();

        return view("admin.news.add",compact("list"));
    }    

    public function insert(Request $req)
    {
        $news=new News();
        if(!empty($req->photo))
        {
            $fileName = (new Upload())->uploadPhoto($req->photo, "images/news", false, false);
            $news->photo=$fileName;
        }
        $news->typeId=$req->typeId;
        $news->title=$req->title;
        $news->subTitle=$req->subTitle;
        $news->dates=$req->dates;
        $news->content=$req->content;
        $news->save();

        Session::flash("message","已新增");
        return redirect("/admin/news/list");
    }
}
