<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    public $timestamps=false;
    protected $table="lan";
    protected $primaryKey="id";
    protected $fillable=[
        "id",
        "title",
        "active"
    ];

    public function getDefaultLan()
    {
        $lan=self::where("active", "Y")->first();
        return $lan;
    }

    public function getLan($id)
    {
        $lan=self::where("id", $id)->first();
        return $lan;
    }
}
