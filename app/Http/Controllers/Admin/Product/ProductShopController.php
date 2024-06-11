<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\ProductShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductShopController extends Controller
{
    public function add(Request $req)
    {
        $itemId=$req->itemId;
        $list=(new ProductShop())->getAddShop($itemId);

        return view("admin.product.shop.add", compact("list", "itemId"));
    }    

    public function insert(Request $req)
    {
        $shop=new ProductShop();
        $shop->itemId=$req->itemId;
        $shop->shopId=$req->shopId;
        $shop->url=$req->url;
        $shop->save();

        Session::flash("message", "商店已新增");
        return redirect("/admin/product/edit/".$req->itemId."#tabs-4");
    }

    public function edit(Request $req)
    {
        $itemId = $req->itemId;
        $id = $req->id;
        $shop = ProductShop::find($id);

        return view("admin.product.shop.edit", compact("itemId", "id", "shop"));
    }            

    public function update(Request $req)
    {
        $itemId = $req->itemId;
        $id = $req->id;
        $shop = ProductShop::find($id);
        $shop->url = $req->url;
        $shop->save();

        Session::flash("message", "商店資訊已修改");
        return redirect("/admin/product/edit/" . $itemId . "#tabs-4");
    }      

    public function delete(Request $req)
    {
        $itemId = "";
        if (!empty($req->shopId)) 
        {
            foreach ($req->shopId as $data) 
            {
                $shop = ProductShop::find($data);
                $itemId = $shop->itemId;
                $shop->delete();
            }

            Session::flash("message", "商品商店已刪除");
            return redirect("/admin/product/edit/" . $itemId . "#tabs-4");
        } else {
            Session::flash("message", "請選擇要刪除的商店");
            return redirect()->back();
        }
    }      
}
