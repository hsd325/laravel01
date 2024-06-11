<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    public $timestamps=false;
    protected $table="counter";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "dates",
        "lan",
        "cnt"
    ];

    public function getDayCounter()
    {
        $list= self::where("lan", session()->get("lan"))
            ->where("dates", date("Y/n/j"))->first();
        

        return $list;
    }

    public function getCounter()
    {
        $list=self::where("lan", session()->get("lan"))
            ->orderby("dates", "ASC")->get();
        
        return $list;
    }
}
