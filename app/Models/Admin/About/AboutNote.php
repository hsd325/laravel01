<?php

namespace App\Models\Admin\About;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutNote extends Model
{
    public $timestamps = false;
    // 資料表名稱
    protected $table = "about_note";
    // 主鍵
    protected $primaryKey = "id";
    // 欄位
    protected $fillable = [
        "id",
        "lan",
        "years",
        "content"
    ];

    public function getList()
    {
        $list=self::where("lan", session()->get("lan"))->orderby("years", "DESC")->get();
        return $list;
        // orderby:排序；以years為主，從小到大排序(DESC)
        // get() : 取得全部資料
    }
}
