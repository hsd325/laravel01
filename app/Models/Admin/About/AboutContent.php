<?php

namespace App\Models\Admin\About;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    public $timestamps = false;
    // 資料表名稱
    protected $table = "about_content";
    // 主鍵
    protected $primaryKey = "id";
    // 欄位
    protected $fillable = [
        "id",
        "lan",
        "content"
    ];

    public function getList()
    {
        $list=self::where("lan", session()->get("lan"))->first();
        return $list;
    }
}
