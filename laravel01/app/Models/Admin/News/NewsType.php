<?php

namespace App\Models\Admin\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsType extends Model
{
    public $timestamps = false;
    // 資料表名稱
    protected $table = "news_type";
    // 主鍵
    protected $primaryKey = "id";
    // 欄位
    protected $fillable = [
        "id",
        "lan",
        "title"
    ];

    public function getList()
    {
        $list=self::where("lan", session()->get("lan"))->get();

        return $list;
    }
}
