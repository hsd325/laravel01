<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\Admin\About\About;
use App\Models\Admin\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    public function list()
    {
        $list = (new About())->getList();

        return view("admin.about.about.list", compact("list"));
    }

    public function add()
    {
        return view("admin.about.about.add");
    }

    public function insert(Request $req)
    {
        $fileName=(new Upload())->uploadPhoto($req->photo, "images/about", false, false);
        $ad= new About();
        $ad->lan=session()->get("lan");
        $ad->title=$req->title;
        $ad->content=$req->content;
        $ad->photo=$fileName;
        $ad->save();

        Session::flash("message", "已新增");
        return redirect("/admin/about/about/list");
    }

    public function edit(Request $req)
    {
        $ad=About::find($req->id);
        return view("admin.about.about.edit", compact("ad"));
    }

    public function update(Request $req)
    {
        if(!empty($req->photo))
        {
            $fileName=(new Upload())->uploadPhoto($req->photo, "images/about", false, false);
        }
        $ad=About::find($req->id);
        $ad->title=$req->title;
        $ad->content=$req->content;
        if(!empty($req->photo))
        {
            @unlink("images/about/" . $req->img);
            $ad->photo=$fileName;          
        }
        $ad->update();

        Session::flash("message", "已修改");
        return redirect("/admin/about/about/list");
    }

    public function delete(Request $req)
    {
        if(!empty($req->id))
        {
        About::destroy($req->id);
        foreach($req->id as $id)
        {
            $about=About::find($id);
            @unlink("images/about/" . $about->photo);
        }
        }

        Session::flash("message", "已刪除");
        return redirect("/admin/about/about/list");
        
    }
}
