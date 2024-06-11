<?php

namespace App\Models\Admin\Manager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public $timestamps=false;
    protected $table="manager";
    protected $primarKey="id";
    protected $fillable=[
        "id",
        "userId",
        "pwd"
    ];

    public function getManager($userId, $pwd)
    {
        $list=self::where("userId", $userId)->where("pwd", $pwd)->first();
        /*
         也可以這樣寫
         $list= DB::table("manager")->where("userId", $userId)->where("pwd", $pwd)->first();
         或者
         $list= DB::select("SELECT * FROM manager WHERE userId = ? AND pwd = ?", [$userId, $pwd]")
         上面這一行如果有資料，取資料時要用 $list[0]->userId, $list[0]->pwd ...等方式
         這2種方式都要 use DB;
        */
        return $list;
    }
}
