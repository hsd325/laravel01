<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    public $timestamps=false;
    protected $table="product";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "lan",
        "layer1",
        "itemNo",
        "itemName",
        "subName",
        "active",
        "home"
    ];

    // 這個函數給後台使用
    public function getList()
    {
        // 原始碼: select a.*, b.layer1_name from `product` as `a` inner join `layer1` as `b` on `a`.`layer1` = `b`.`id` where `b`.`lan` = 1
        $list=DB::table("product AS a")//找哪個資料表
        ->selectRaw("a.*, b.layer1_name")//selectRaw :顯示；顯示a的左有欄位和b的layer1_name的欄位
        ->join("layer1 AS b", "a.layer1", "b.id")//join :合併；以a為主來合併b(layer1)，以a的layer1和b的id為基準來合併
        //inner join:合併時，以左邊的資料表(a)為主
        // on :2個資料表合併必須要用到的； inner join `layer1` as `b` on `a`.`layer1` = `b`.`id`
        ->where("b.lan", session()->get("lan"))// where，依照語系(lan)來判斷要撈哪些資料；以b的lan；當lan=1的時候->where `b`.`lan` = 1;
        ->paginate(10);
        // ->get();
        // dd($list);
        return $list;
    }

    // 這個函數給前台使用
    public function getHomeProduct()
    {
        //原始碼: SELECT id, itemName, subName,(SELECT photo FROM product_photo WHERE itemId= a.id LIMIT 1) AS photo FROM product a WHERE home ='Y' AND active= 'Y' AND a.lan = 1;
        $list=DB::select("SELECT id, itemName, subName,(SELECT photo FROM product_photo WHERE itemId= a.id LIMIT 1) AS photo FROM product a WHERE home ='Y' AND active= 'Y' AND a.lan = ?", [session()->get("lan")]);
        // LIMIT 1 只顯示第一筆的意思，後面的不會顯示
        // product a 為product AS a的簡寫
        // a.lan = ?", [session()->get("lan")]；【?】的內容為【session()->get("lan")】，需要【，】來連接
        return $list;
    }

    public function getLayer1($layer1)
    {
        $list=DB::select("SELECT id, itemName, subName,(SELECT photo FROM product_photo WHERE itemId= a.id LIMIT 1) AS photo FROM product a WHERE layer1 =? AND active= 'Y'", [$layer1]);

        return $list;
    }
}
