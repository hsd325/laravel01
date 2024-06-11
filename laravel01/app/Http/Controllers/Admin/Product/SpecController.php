<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Spec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SpecController extends Controller
{
    public function add(Request $req)
    {
        $itemId = $req->itemId;
        return view("admin.spec.add", compact("itemId"));
    }

    public function insert(Request $req)
    {
        $itemId = $req->itemId;
        $spec = new Spec();
        $spec->itemId = $itemId;
        $spec->title = $req->title;
        $spec->content = $req->content;
        $spec->save();

        Session::flash("message", "規格已新增");
        return redirect("/admin/product/edit/" . $itemId . "#tabs-3");
    }

    public function edit(Request $req)
    {
        $itemId = $req->itemId;
        $id = $req->id;
        $spec = Spec::find($id);

        return view("admin.spec.edit", compact("itemId", "id", "spec"));
    }

    public function update(Request $req)
    {
        $itemId = $req->itemId;
        $id = $req->id;
        $spec = Spec::find($id);
        $spec->title = $req->title;
        $spec->content = $req->content;
        $spec->save();

        Session::flash("message", "規格已修改");
        return redirect("/admin/product/edit/" . $itemId . "#tabs-3");
    }

    public function delete(Request $req)
    {
        $itemId = "";
        if (!empty($req->specId)) {
            foreach ($req->specId as $data) 
            {
                $spec = Spec::find($data);
                // 商品id，在講下面這行
                $itemId = $spec->itemId;
                // 將商品圖從資料庫刪除
                $spec->delete();
            }

            Session::flash("message", "規格已刪除");
            return redirect("/admin/product/edit/" . $itemId . "#tabs-3");
        } else {
            Session::flash("message", "請選擇要刪除的規格");
            return redirect()->back();
        }
    }
}
