<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\Admin\News\NewsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsTypeController extends Controller
{
    public function list()
    {
        $list=(new NewsType())->getList();
        return view("admin.news.type.list",compact("list"));
    }

    public function add()
    {
        return view("admin.news.type.add");
    }    

    // 分類-切換語系
    public function insert(Request $req)
    {
        $tp=new NewsType();
        $tp->title=$req->title;
        $tp->lan=session()->get("lan");
        $tp->save();

        Session::flash("message","已新增");
        Session::forget("layer1");
        return redirect("/admin/news/type/list");
    }

    public function edit(Request $req)
    {
        $list=NewsType::find($req->id);
        return view("admin.news.type.edit", compact("list"));
    }            

    public function update(Request $req)
    {
        $tp=NewsType::find($req->id);
        $tp->title=$req->title;
        $tp->save();

        Session::flash("message","已修改");
        return redirect("/admin/news/type/list");
    }      

    public function delete(Request $req)
    {
        NewsType::destroy($req->id);
        Session::flash("message","已刪除");
        return redirect("/admin/news/type/list");
    }      
}
