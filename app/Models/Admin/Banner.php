<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Banner extends Model
{
    public $timestamps=false;
    protected $table="banner";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "apId",
        "photo"
    ];

    public function getList()
    {
        $list= DB::table("banner as a")
            ->selectRaw("a.*, b.app")
            ->leftjoin("menu as b", "a.apId", "b.id")
            ->where("lan", session()->get("lan"))
            ->orwhere("a.apId", "0")
            ->get();

        return $list;
    }

    public function getBanner($apId)
    {
        $list = self::where("apId", $apId)->first();
        return $list;
    }
}
