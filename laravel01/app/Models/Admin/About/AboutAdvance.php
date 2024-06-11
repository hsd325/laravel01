<?php

namespace App\Models\Admin\About;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutAdvance extends Model
{
    public $timestamps = false;
    // 資料表名稱
    protected $table = "about_advance";
    // 主鍵
    protected $primaryKey = "id";
    // 欄位
    protected $fillable = [
        "id",
        "lan",
        "title",
        "content",
        "photo"
    ];

    public function getList()
    {
        $list=self::where("lan", session()->get("lan"))->get();
        return $list;
    }
}
