<?php

namespace App\Http\Controllers\Admin\Product;

use App\Exports\ExportProduct;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Layer1;
use App\Models\Admin\Product\Photo;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductContent;
use App\Models\Admin\Product\ProductShop;
use App\Models\Admin\Product\Resize;
use App\Models\Admin\Product\Spec;
use App\Models\Admin\Shop\Shop;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\PDF;
use TCPDF;

class ProductController extends Controller
{
    public function list()
    {
        $list = (new Product())->getList();

        return view("admin.product.list", compact("list"));
    }

    public function add()
    {
        $layer1 = (new Layer1())->getLayer1();
        $shop = Shop::get();

        return view("admin.product.add", compact("layer1", "shop"));
    }

    public function insert(Request $req)
    {
        // 開始交易
        DB::beginTransaction();
        try {
            // this: 意思為當前的檔案(ProductController.php)的意思，這個物件，在java及.net中也是使用this
            // 基本資料，使用函數addProduct
            $id = $this->addProduct($req);
            // 商店，使用函數addProductShop
            $this->addProductShop($req, $id);
            // 規格，使用函數addSpec
            $this->addSpec($id);
            // 圖片，使用函數addPhoto
            // $this->addPhoto($id); : 意思為從當前的檔案抓addPhoto函數出來，並且執行；【->】為【的】的意思
            $this->addPhoto($id);
            // 產品內容
            $this->addContent($req, $id);

            DB::commit();
        } catch (Exception $e) {
            // 有錯誤發生時，將資料全部倒回去
            DB::rollback();
            // 丟出錯誤訊息
            throw $e;
            exit;
        }

        Session::flash("message", "已新增");
        return redirect("/admin/product/list");
    }

    
    // 是給insert函數用的
    // 基本資料
    private function addProduct(Request $req)
    {
        $product = new Product();
        // 切換產品-會依照語系出現不同的商品
        $product->lan=session()->get("lan");
        // 類別的id
        $product->layer1 = $req->layer1;
        // 商品編號
        $product->itemNo = $req->itemNo;
        // 商品名稱
        $product->itemName = $req->itemName;
        // 商品標題
        $product->subName = $req->subName;
        // 如果使用中有選取，設為Y，否則為null
        $product->active = !empty($req->active) ? $req->active : null;
        // 如果首頁有選取(此商品會放在首頁)，設為Y，否則為null
        $product->home = !empty($req->home) ? $req->home : null;
        $product->save();

        // 取得新增資料的id 有兩種方式
        // 另一種方式: DB::getPdo()->lastInsertId();
        return $product->id;
    }

    // 是給insert函數用的
    // 商店
    private function addProductShop(Request $req, $id)
    {
        // 取得所有商店資料
        $shopList = Shop::get();

        // 取得所有輸入的資料
        $input = request()->all();

        // 寫入product_shop(商品所在商店)
        foreach ($shopList as $data) {
            // 如果商店有被選取
            if (!empty($input["shop" . $data->id])) {
                $shop = new ProductShop();
                $shop->itemId = $id; // 商品的id
                $shop->shopId = $data->id; // 商店的id
                $shop->url = $input["url" . $data->id]; // 所輸入的網址
                $shop->save();
            }
        }
    }

    // 商品規格
    private function addSpec($id)
    {
        // 取得全部輸入的資料
        $input = request()->all();
        // 在view 中是10筆，所以for迴圈為10筆
        for ($i = 1; $i <= 10; $i++) {
            // 如果規格的名稱有輸入資料
            if (!empty($input["title" . $i])) {
                $spec = new Spec();
                // 商品的id
                $spec->itemId = $id;
                // 第1筆所輸入的規格名稱
                $spec->title = $input["title" . $i];
                // 第i筆所輸入的規格內容
                $spec->content = $input["content" . $i];
                $spec->save();
            }
        }
    }

    // 商品圖片
    private function addPhoto($id)
    {
        $input = request()->all();
        // 如果public資料夾沒有images資料夾
        if (!file_exists("images")) {
            // 建立一個images資料夾， 權限為777(允許讀取、執行、寫入)
            mkdir("images", 0777, true);
        }

        // 如果public/images資料夾下沒有product資料夾
        if (!file_exists("images/product")) {
            // 建立一個product資料夾(在images裡面)， 權限為777(允許讀取、執行、寫入)
            mkdir("images/product", 0777, true);
        }

        foreach (range("1", "5") as $cnt) {
            if (!empty($input["file" . $cnt])) {
                $file = $input["file" . $cnt];
                // explode: 分割，分割字串後的資料型態為陣列
                // 將自系統取得的微秒(1/1000秒)做字串分割
                $times = explode(" ", microtime());
                // extension: 副檔名
                // 將檔名重新名為: 年_月_日_時_分_秒_微秒.副檔名
                $fs = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]) . substr($times[0], 2, 3);
                // $picture: 為上傳圖片的副檔名的抓取
                // $picture必須在【 $file->move("images/product", $fileName);】前面，要不然圖檔被刪掉的話就找不到副檔名了
                $picture = $file->extension();

                $fileName = $fs . "." . $file->extension();

                // 將上傳的檔案由暫存區移至images/product資料夾之下
                $file->move("images/product", $fileName);
                // $path為放圖片大、中、小(縮圖)的地方
                $path = "images/product/";

                // path."M/".$fileName: 儲存圖片的位置，使用Resize.php來完成
                // $path.$fileName, 80, 80, "0", "0": 儲存圖片中(middle)和小(縮圖)的方式，使用Resize.php來完成
                // $picture: 為判斷圖片檔案為jpg還是png
                new Resize($path . "M/" . $fileName, $path . $fileName, 490, 490, "0", "0", $picture);
                new Resize($path . "S/" . $fileName, $path . $fileName, 80, 80, "0", "0", $picture);

                $photo = new Photo();
                $photo->itemId = $id;
                $photo->photo = $fileName;
                $photo->save();
            }
        }
    }

    public function addContent(Request $req, $id)
    {
        $content= new ProductContent();
        $content->itemId= $id;
        $content->content= $req->content;
        $content->save();
    }

    public function edit(Request $req)
    {
        $product = Product::find($req->id);
        $id = $req->id;
        // 下面三行為資料表有索引，所以要這樣寫
        $shop = (new ProductShop())->getShop($req->id);
        $photo = (new Photo())->getPhoto($req->id);
        $spec = (new Spec())->getSpec($req->id);
        $layer1 = (new Layer1())->getLayer1();
        $content = (new ProductContent())->getContent($req->id);

        return view("admin.product.edit", compact("product", "shop", "photo", "spec", "layer1", "content", "id"));
    }

    public function update(Request $req)
    {
        $product = Product::find($req->id);
        $product->itemNo = $req->itemNo;
        $product->layer1 = $req->layer1;
        $product->itemName = $req->itemName;
        $product->subName = $req->subName;
        $product->home = $req->home;
        $product->active = $req->active;
        $product->save();

        // 內容欄位的更新
        $content= (new ProductContent())->getContent($req->id);

        if(empty($content))
        {
            $content= new ProductContent();
            $content->itemId= $req->id;
        }
        $content->content= $req->content;
        $content->save();

        Session::flash("message", "已修改");
        return redirect("/admin/product/list");
    }

    public function delete(Request $req)
    {
        $ids = $req->id;
        if (!empty($ids)) {
            foreach ($ids as $id) {
                DB::beginTransaction();
                try {
                    // dd($id);
                 (new Spec())->deleteSpec($id);
                    // new的意思是讓model實體化，才能使用他的函式

                    $photo = (new Photo())->getPhoto($id);
                    if (!empty($photo->photo)) {
                        @unlink("images/product/" . $photo->photo);
                        @unlink("images/product/M/" . $photo->photo);
                        @unlink("images/product/S/" . $photo->photo);
                    }
                    (new Photo())->deletePhoto($id);

                    (new ProductShop())->deleteShop($id);
                    Product::destroy($id);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    throw $e;
                }
            }
        }

        Session::flash("message", "產品已刪除");

        return redirect("/admin/product/list");
    }
    
    public function word(Request $req)
    {
        $item = Product::find($req->id);
        $photo = (new Photo())->getPhoto($req->id);

        $temp = new TemplateProcessor("temp/product.docx");
        $temp->setValue("itemNo", $item->itemNo);
        $temp->setValue("itemName", $item->itemName);
        $temp->setValue("subName", $item->subName);

        if (!empty($photo) && sizeof($photo) > 0) {
            $cnt = 0;
            foreach ($photo as $data) {
                $cnt++;
                $temp->setImageValue("photo" . $cnt, "images/product/" . $data->photo);
            }
        }

        for ($i = sizeof($photo) + 1; $i <= 6; $i++) {
            // 刪除多餘的
            $temp->deleteRow("photo" . $i, "");
            // 將多餘的設為空白
            // $temp->setValue("photo".$i,"");
        }

        header("Content-Type:application/vnd.ms-word");
        header("Content-Disposition:attachment;filename=" . $item->itemName . ".docx");
        header("Cache-Control:max-age=0");
        $temp->saveAs("php://output");
    }

    public function pdf(Request $req)
    {
        // 安裝: composer require tecnickcom/tcpdf
        // 將DroidSansFallback等4個檔案複製到vendor/tecnickocom/tcpdf/fonts之下
        $item = Product::find($req->id);
        $photo = (new Photo())->getPhoto($req->id);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);
        // $pdf->SetCreator("雲端技術班");

        $pdf->SetTitle("餐卡");
        // 設定檔頭字型
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN));

        // 設定邊界
        $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(0);
        $pdf->setFooterMargin(0);
        $pdf->setPrintFooter(false);
        $pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(false);

        // 文件開始，新增一頁

        $pdf->Addpage();

        $pdf->Image("temp/card.jpg", 20, 20, 210, 297, "", "", "", false, 300, "", false, false, 0);



        $photo = "images/product/" . $photo[0]->photo;
        $pdf->Image($photo, 98, 73.2, 18, 18, "", "", "", false, 300, "", false, false, 0);

        $pdf->setFont("DroidSansFallback", "", 14, "", true);
        $pdf->SetXY(85, 99);
        $pdf->Write(0, $item->id);

        $pdf->SetXY(96, 99);
        $pdf->Write(0, $item->itemName);

        $pdf->SetFont("DroidSansFallback", "", 20, "", true);
        $pdf->SetXY(94, 110);
        $pdf->Write(0, $item->subTitle);

        // I:網頁瀏覽 D:下載
        ob_end_clean();
        $pdf->Output("餐卡.pdf", "I");
    }

    public function pdfList(Request $req)
    {
        // 安裝: composer require tecnickcom/tcpdf
        // 將DroidSansFallback等4個檔案複製到vendor/tecnickocom/tcpdf/fonts之下
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);
        // $pdf->SetCreator("雲端技術班");

        $pdf->SetTitle("餐卡");
        // 設定檔頭字型
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN));

        // 設定邊界
        $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(0);
        $pdf->setFooterMargin(0);
        $pdf->setPrintFooter(false);
        $pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(false);

        $product = Product::get();
        foreach ($product as $item) {

            $photo = (new Photo())->getPhoto($item->id);

            $pdf->Addpage();

            $pdf->Image("temp/card.jpg", 20, 20, 210, 297, "", "", "", false, 300, "", false, false, 0);

            if (!empty($photo) && sizeof($photo) > 0) {

                $photo = "images/product/" . $photo[0]->photo;
                $pdf->Image($photo, 98, 73.2, 18, 18, "", "", "", false, 300, "", false, false, 0);
            }

            $pdf->setFont("DroidSansFallback", "", 14, "", true);
            $pdf->SetXY(85, 99);
            $pdf->Write(0, $item->id);

            $pdf->SetXY(96, 99);
            $pdf->Write(0, $item->itemName);

            $pdf->SetFont("DroidSansFallback", "", 20, "", true);
            $pdf->SetXY(94, 110);
            $pdf->Write(0, $item->subTitle);
        }
        // I:網頁瀏覽 D:下載
        ob_end_clean();
        $pdf->Output("餐卡.pdf", "I");
    }

    public function excel()
    {
        return Excel::download(new ExportProduct,"產品.xlsx");
    }
}
