<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\Admin\About\AboutNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutNoteController extends Controller
{
    public function list()
    {
        $list = (new AboutNote())->getList();

        return view("admin.about.note.list", compact("list"));
    }

    public function add()
    {
        return view("admin.about.note.add");
    }

    public function insert(Request $req)
    {
        $note= new AboutNote();
        $note->lan=session()->get("lan");
        $note->years=$req->years;
        $note->content=$req->content;
        $note->save();

        Session::flash("message", "記事已更新");
        return redirect("/admin/about/note/list");
    }

    public function edit(Request $req)
    {
        $note=AboutNote::find($req->id);
        return view("admin.about.note.edit", compact("note"));
    }

    public function update(Request $req)
    {
        $note=AboutNote::find($req->id);
        $note->years=$req->years;
        $note->content=$req->content;
        $note->update();

        Session::flash("message", "記事已修改");
        return redirect("/admin/about/note/list");
    }

    public function delete(Request $req)
    {
        AboutNote::destroy($req->id);

        Session::flash("message", "記事已刪除");
        return redirect("/admin/about/note/list");
    }
}
