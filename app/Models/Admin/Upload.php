<?php

namespace App\Models\Admin;

use App\Models\Admin\Product\Resize;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public function uploadPhoto($photo, $path, $middle, $small)
    {
        if(!file_exists($path))
            mkdir($path, 0777, true);
        
        // $type: 為上傳圖片的副檔名的抓取
        $type = $photo->extension();
        $times = explode(" ", microtime());
        // extension: 副檔名
        // 將檔名重新名為: 年_月_日_時_分_秒_微秒.副檔名
        $fileName = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]).substr($times[0], 2, 3). "." . $type;
        // 將上傳的檔案由暫存區移至資料夾之下
        $photo->move($path, $fileName);

        if($middle)
        {
            if(!file_exists($path."/M"))
            {
                mkdir($path."/M", 077, true);
            }
            new Resize($path."/M/".$fileName, $path."/".$fileName, 490, 490, "0", "0", $type);
        }

        if($small)
        {
            if(!file_exists($path."/S"))
            {
                mkdir($path."/S", 077, true);
            }
            new Resize($path."/S/".$fileName, $path."/".$fileName, 80, 80, "0", "0", $type);
        }

        return $fileName;        
    }
    
}
