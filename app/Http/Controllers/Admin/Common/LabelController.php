<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Controller;
use App\Models\Admin\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LabelController extends Controller
{
    public function list()
    {
        $list=(new Label())->getList();

        return view("admin.label.list", compact("list"));
    }

    public function add()
    {
        return view("admin.label.add");
    }

    // 選單-新增語系
    public function insert(Request $req)
    {
        $label=new Label();
        $label->labels=$req->label;
        $label->lan=session()->get("lan");
        $label->title=$req->title;
        $label->content=$req->content;
        $label->save();

        Session::flash("message", "已新增");
        return redirect("/admin/label/list");
    }

    public function edit(Request $req)
    {
        $label=Label::find($req->id);
        return view("admin.label.edit", compact("label"));
    }

    public function update(Request $req)
    {
        $label=Label::find($req->id);
        $label->labels=$req->label;
        $label->title=$req->title;
        $label->content=$req->content;
        $label->update();

        Session::flash("message", "已修改");
        return redirect("/admin/label/list");
    }

    public function delete(Request $req)
    {
        Label::destroy($req->id);
        Session::flash("message", "已刪除");
        return redirect("/admin/label/list");
    }

}
