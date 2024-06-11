<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps=false;
    protected $table="menu";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "lan",
        "app",
        "url"
    ];

    // 前台的選單判斷會撈這個函數來執行，這個執行會分辨語系，決定要出現哪些產品
    public function getList()
    {
        $list=self::where("lan", session()->get("lan"))->get();
        return $list;
    }
}
