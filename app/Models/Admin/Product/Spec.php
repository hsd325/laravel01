<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    public $timestamps=false;
    protected $table="spec";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "itemId",
        "itemId",
        "content"
    ];

    public function getSpec($itemId)
    {//在資料表有用索引的，要寫這個函數
        $list=self::where("itemId",$itemId)->get();
        return $list;
    }

    public function deleteSpec($itemId)
    {
        self::where("itemId",$itemId)->delete();
    }
}
