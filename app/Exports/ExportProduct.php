<?php

namespace App\Exports;

use App\Models\Admin\Product\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

// 建造這個php檔案的指令:php artisan make:export ExportProduct --model=Admin/Product/Product
class ExportProduct implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $list = DB::select("SELECT b.layer1_name, a.itemNo,a.itemName,a.subName,
        (SELECT CONCAT('I:\\\\php\\\\lararvel\\\\cloude03\\\\public\\\\images\\\\product\\\\',photo) 
        AS photo FROM product_photo WHERE itemId = a.id LIMIT 1) AS photo
        FROM product a INNER JOIN layer1 b ON a.layer1=b.id 
        WHERE a.lan = ?", [session()->get("lan")]);

        return collect($list);
    }

    public function headings():array{
        return[
            "類別",
            "產品編號",
            "品名",
            "標題",
            "圖檔"
        ];
    }
}
