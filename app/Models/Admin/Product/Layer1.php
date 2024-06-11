<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layer1 extends Model
{
    public $timestamps = false;
    // 資料表名稱
    protected $table = "layer1";
    // 主鍵
    protected $primaryKey = "id";
    // 欄位
    protected $fillable = [
        "id",
        "lan",
        "layer1_name"
    ];

    // 前台的產品判斷會撈這個函數來執行，這個執行會分辨語系，決定要出現哪些產品
    public function getLayer1()
    {
        $list=self::where("lan", session()->get("lan"))->get();
        return $list;
    }
}
