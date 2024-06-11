<?php

namespace App\Models\Admin\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class News extends Model
{
    public $timestamps = false;
    // 資料表名稱
    protected $table = "news";
    // 主鍵
    protected $primaryKey = "id";
    // 欄位
    protected $fillable = [
        "id",
        "typeId",
        "title",
        "subTitle",
        "photo",
        "content",
        "dates",
        "createDate"
    ];

    public function getList()
    {
        $list=DB::table("news AS a")->join("news_type AS b","a.typeId","b.id")
        ->selectRaw("a.*,b.title AS typeName")
        ->where("b.lan",session()->get("lan"))
        ->orderby("a.dates","DESC")
        ->paginate(10);

        return $list;
    }
    public function getFrontList($dates,$typeId)
    {
        $sql=DB::table("news");
        if(!empty($dates))
        {
            $sql->whereYear("dates",$dates);
        }
        if(!empty($typeId))
        {
            $sql->where("typeId",$typeId);
        }

        $list=$sql->orderby("dates","DESC")->get();
        return $list;
    }

    public function getDateList()
    {
        $list=DB::table("news as a")
        ->join("news_type as b","a.typeId","b.id")
        ->where("b.lan",session()->get("lan"))
        ->selectRaw("Year(a.dates)as year")->distinct()->get();

        return $list;
    }
}
