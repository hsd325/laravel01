<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\Admin\About\AboutAdvance;
use App\Models\Admin\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutAdvanceController extends Controller
{
    public function list()
    {
        $list = (new AboutAdvance())->getList();

        return view("admin.about.advance.list", compact("list"));
    }

    public function add()
    {
        return view("admin.about.advance.add");
    }

    public function insert(Request $req)
    {
        $fileName=(new Upload())->uploadPhoto($req->photo, "images/about", false, false);
        $ad= new AboutAdvance();
        $ad->lan=session()->get("lan");
        $ad->title=$req->title;
        $ad->content=$req->content;
        $ad->photo=$fileName;
        $ad->save();

        Session::flash("message", "已新增");
        return redirect("/admin/about/advance/list");
    }

    public function edit(Request $req)
    {
        $ad=AboutAdvance::find($req->id);
        return view("admin.about.advance.edit", compact("ad"));
    }

    public function update(Request $req)
    {
        if(!empty($req->photo))
        {
            $fileName=(new Upload())->uploadPhoto($req->photo, "images/about", false, false);
        }
        $ad=AboutAdvance::find($req->id);
        $ad->title=$req->title;
        $ad->content=$req->content;
        if(!empty($req->photo))
        {
            @unlink("images/about/" . $req->img);
            $ad->photo=$fileName;          
        }
        $ad->update();

        Session::flash("message", "已修改");
        return redirect("/admin/about/advance/list");
    }

    public function delete(Request $req)
    {
        AboutAdvance::destroy($req->id);

        Session::flash("message", "已刪除");
        return redirect("/admin/about/advance/list");
    }
}
