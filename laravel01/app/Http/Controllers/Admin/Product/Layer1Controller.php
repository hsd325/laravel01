<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Layer1;
use App\Models\Admin\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// 給後臺類別使用的
class Layer1Controller extends Controller
{
    public function list()
    {
        $list=(new Layer1())->getLayer1();
        return view("admin.layer1.list",compact("list"));
    }

    public function add()
    {
        return view("admin.layer1.add");
    }    

    // 分類-切換語系
    public function insert(Request $req)
    {
        $layer1=new Layer1();
        $layer1->layer1_name=$req->layer1_name;
        $layer1->lan=session()->get("lan");
        $layer1->save();

        Session::flash("message","已新增");
        Session::forget("layer1");
        return redirect("/admin/layer1/list");
    }

    public function edit(Request $req)
    {
        $layer1=Layer1::find($req->id);
        return view("admin.layer1.edit", compact("layer1"));
    }            

    public function update(Request $req)
    {
        $layer1=Layer1::find($req->id);
        $layer1->layer1_name=$req->layer1_name;
        $layer1->save();

        Session::flash("message","已修改");
        return redirect("/admin/layer1/list");
    }      

    public function delete(Request $req)
    {
        Layer1::destroy($req->id);
        Session::flash("message","已刪除");
        return redirect("/admin/layer1/list");
    }      
}
