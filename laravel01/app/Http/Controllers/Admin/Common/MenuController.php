<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function list()
    {
        $list=(new Menu())->getList();

        return view("admin.menu.list", compact("list"));
    }

    public function add()
    {
        return view("admin.menu.add");
    }

    // 選單-新增語系
    public function insert(Request $req)
    {
        $menu=new Menu();
        $menu->lan=session()->get("lan");
        $menu->app=$req->app;
        $menu->url=$req->url;
        $menu->save();

        Session::flash("message", "選單已新增");
        return redirect("/admin/menu/list");
    }

    public function edit(Request $req)
    {
        $menu=Menu::find($req->id);
        return view("admin.menu.edit", compact("menu"));
    }

    public function update(Request $req)
    {
        $menu=Menu::find($req->id);
        $menu->app=$req->app;
        $menu->url=$req->url;
        $menu->update();

        Session::flash("message", "選單已修改");
        return redirect("/admin/menu/list");
    }

    public function delete(Request $req)
    {
        Menu::destroy($req->id);
        Session::flash("message", "選單已刪除");
        return redirect("/admin/menu/list");
    }

}
