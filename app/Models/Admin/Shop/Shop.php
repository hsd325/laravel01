<?php

namespace App\Models\Admin\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public $timestamps=false;
    protected $table="shop";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "title"
    ];
}
