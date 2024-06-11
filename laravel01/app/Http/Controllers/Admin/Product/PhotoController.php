<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Photo;
use App\Models\Admin\Product\Resize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhotoController extends Controller
{
    public function add(Request $req)
    {
        $itemId = $req->itemId;
        return view("admin.photo.add", compact("itemId"));
    }

    public function insert(Request $req)
    {
        $file = $req->photo;
        $times = explode(" ", microtime());
        // extension: 副檔名
        // 將檔名重新名為: 年_月_日_時_分_秒_微秒.副檔名
        $fileName = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]).substr($times[0], 2, 3).".".$file->extension(); 
        // $picture: 為上傳圖片的副檔名的抓取
        // $picture必須在【 $file->move("images/product", $fileName);】前面，要不然圖檔被刪掉的話就找不到副檔名了
        $picture=$file->extension();
        // $path為放圖片大、中、小(縮圖)的地方
        $path = "images/product/";
        // 將上傳的檔案由暫存區移至images/product資料夾之下
        $file->move("images/product", $fileName);

        
        // path."M/".$fileName: 儲存圖片的位置，使用Resize.php來完成
        // $path.$fileName, 80, 80, "0", "0": 儲存圖片中(middle)和小(縮圖)的方式，使用Resize.php來完成
        new Resize($path."/M/".$fileName, $path.$fileName, 490, 490, "0", "0",$picture);
        new Resize($path."/S/".$fileName, $path.$fileName, 80, 80, "0", "0",$picture);

        $photo = new Photo();
        $photo->itemId = $req->itemId;
        $photo->photo = $fileName;
        $photo->save();

        Session::flash("message", "圖檔已新增");
        return redirect("/admin/product/edit/" . $req->itemId . "#tabs-2");
    }

    public function delete(Request $req)
    {
        $itemId = "";
        if (!empty($req->photoId)) {
            foreach ($req->photoId as $data) {
                $photo = Photo::find($data);
                // 商品id，在講下面這行
                $itemId = $photo->itemId;
                // 將圖檔從資料夾(images/product)中刪除
                @unlink("images/product/" . $photo->photo);
                @unlink("images/product/M/" . $photo->photo);
                @unlink("images/product/S/" . $photo->photo);
                // 將商品圖從資料庫中刪除
                $photo->delete();
            }

            Session::flash("message", "圖檔已刪除");
            return redirect("/admin/product/edit/" . $itemId . "#tabs-2");
        } else {
            Session::flash("message", "請選擇要刪除的圖檔");
            return redirect()->back();
        }
    }
}
