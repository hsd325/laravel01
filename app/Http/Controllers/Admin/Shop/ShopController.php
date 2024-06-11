<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Admin\Shop\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function Psy\sh;

class ShopController extends Controller
{
    public function list()
    {
        $list=Shop::get();
        return view("admin.shop.list", compact("list"));
    }

    public function add()
    {
        return view("admin.shop.add");
    }    

    public function insert(Request $req)
    {
        $shop=new Shop();
        $shop->title=$req->title;
        $shop->save();

        Session::flash("message","已新增");
        return redirect("/shop/list");
    } 

    public function edit(Request $req)
    {
        $shop=Shop::find($req->id);
        return view("admin.shop.edit", compact("shop"));
    }      

    public function update(Request $req)
    {
        $shop=Shop::find($req->id);
        $shop->title=$req->title;
        $shop->save();

        Session::flash("message","已修改");
        return redirect("/shop/list");
    }      

    public function delete(Request $req)
    {
        Shop::destroy($req->id);
        Session::flash("message","已刪除");
        return redirect("/shop/list");
    }      
}
