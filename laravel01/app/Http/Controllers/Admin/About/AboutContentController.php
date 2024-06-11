<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\Admin\About\AboutContent;
use App\Models\Admin\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutContentController extends Controller
{
    public function list()
    {
        $list = (new AboutContent())->getList();

        return view("admin.about.content.list", compact("list"));
    }

    public function add()
    {
        return view("admin.about.content.add");
    }

    public function insert(Request $req)
    {
        $content = $req->content;
        if (!empty($content)) {
            $content = str_replace("\n", "<br/>", $content);
            $ad = new AboutContent();
            $ad->lan = session()->get("lan");
            $ad->content = $req->content;
            $ad->save();

            Session::flash("message", "已新增");
            return redirect("/admin/about/content/list");
        } else {
            Session::flash("message", "請輸入內容");
            return redirect()->back();
        }
    }

    public function edit(Request $req)
    {
        $ad = AboutContent::find($req->id);
        return view("admin.about.content.edit", compact("ad"));
    }

    public function update(Request $req)
    {
        $content = $req->content;
        if (!empty($content)) {
            $content = str_replace("\n", "<br/>", $content);
            $content = AboutContent::find($req->id);
            $content->content = $content;
            $content->update();

            Session::flash("message", "已修改");
            return redirect("/admin/about/content/list");
        }else{
            Session::flash("message", "請輸入內容");
            return redirect()->back();
        }
    }

    public function delete(Request $req)
    {
        if (!empty($req->id)) {
            AboutContent::destroy($req->id);
            foreach ($req->id as $id) {
                $about = AboutContent::find($id);
                @unlink("images/about/" . $about->photo);
            }
        }

        Session::flash("message", "已刪除");
        return redirect("/admin/about/content/list");
    }
}
