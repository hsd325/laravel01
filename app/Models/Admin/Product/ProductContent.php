<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductContent extends Model
{
    public $timestamps=false;
    protected $table="product_content";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "itemId",
        "content"
    ];

    public function getContent($itemId)
    {
        $list= self::where("itemId", $itemId)->first();
        return $list;
    }
}
