<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Menu;
use App\Models\Admin\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    public function list()
    {
        $list = (new Banner())->getList();

        return view("admin.banner.list", compact("list"));
    }

    public function add()
    {
        $ap = (new Menu())->getList();

        return view("admin.banner.add", compact("ap"));
    }

    public function insert(Request $req)
    {
        $fileName = (new Upload())->uploadPhoto($req->photo, "images/banner", false, false);
        $banner = new Banner();
        $banner->apId = $req->apId;
        $banner->photo = $fileName;
        $banner->save();

        Session::flash("message", "Banner已更新");
        return redirect("/admin/banner/list");
    }

    public function edit(Request $req)
    {
        $banner = Banner::find($req->id);
        return view("admin.banner.edit", compact("banner"));
    }

    public function update(Request $req)
    {
        if (!empty($req->photo)) 
        {
            $fileName = (new Upload())->uploadPhoto($req->photo, "images/banner", false, false);
            $banner = Banner::find($req->id);
            $image = $banner->photo;

            $banner->photo = $fileName;
            $banner->save();

            @unlink("images/banner/" . $image);
        }

        Session::flash("message", "Banner已修改");
        return redirect("/admin/banner/list");
    }

    public function delete(Request $req)
    {
        if(!empty($req->id))
        {
            foreach($req->id as $id)
            {
                $banner=Banner::find($id);
                @unlink("images/banner/" . $banner->photo);
                $banner->delete();
            }
        }
        
        Session::flash("message", "已刪除");
        return redirect("/admin/banner/list");
    }
}
