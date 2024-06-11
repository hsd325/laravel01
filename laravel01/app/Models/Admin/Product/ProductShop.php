<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProductShop extends Model
{
    public $timestamps=false;
    protected $table="product_shop";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "itemId",
        "shopId",
        "url"
    ];

    public function getShop($itemId)
    {//在資料表有用索引的，要寫這個函數
        
        $list=DB::table("product_shop AS a")
            ->selectRaw("a.*, b.title")
            ->join("shop AS b", "a.shopId", "b.id")
            ->where("a.itemId", $itemId)->get();

        return $list;
    }

    //區分已存在和未存在的商店
    public function getAddShop($itemId)
    {
        $list=DB::table("shop")
            ->selectRaw("*")
            ->whereNotIn("id", DB::table("product_shop")->selectRaw("shopId")->where("itemId",$itemId))
            ->get();

            /*也可以這樣寫:
                $list=DB::select("SELECT * FROM shop
                    WHERE id NOT IN(SELECT ahopId FROM product_shop WHERE itemId = ?"), [$itemId])
            */
        return $list;
    }

    public function deleteShop($itemId)
    {
        self::where("itemId",$itemId)->delete();
    }
}
