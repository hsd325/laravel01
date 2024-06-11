<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    public $timestamps = false;
    // 資料表名稱
    protected $table = "labels";
    // 主鍵
    protected $primaryKey = "id";
    // 欄位
    protected $fillable = [
        "id",
        "labels",
        "lan",
        "title",
        "content"
    ];

    public function getList()
    {
        $list=self::where("lan", session()->get("lan"))->get();
        return $list;
    }

    public function getLabel($label)
    {
        $list=self::where("lan", session()->get("lan"))->where("labels", $label)->first();
        
        return $list;
    }
}
