<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $timestamps=false;
    protected $table="product_photo";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "itemId",
        "photo"
    ];

    public function getPhoto($itemId)
    {//在資料表有用索引的，要寫這個函數
        $list=self::where("itemId",$itemId)->get();
        return $list;
    }

    public function deletePhoto($itemId)
    {
        self::where("itemId",$itemId)->delete();
    }
}
