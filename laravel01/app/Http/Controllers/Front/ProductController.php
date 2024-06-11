<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Product\Photo;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductContent;
use App\Models\Admin\Product\ProductShop;
use App\Models\Admin\Product\Spec;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail(Request $req)
    {
        $id=$req->id;
        $product=Product::find($id);
        $photo=(new Photo())->getPhoto($id);
        $spec=(new Spec())->getSpec($id);
        $shop=(new ProductShop())->getShop($id);
        $content= (new ProductContent())->getContent($id);

        return view("front.product.detail",
                compact("product", "photo", "spec", "shop", "content"));
    }

    public function list(Request $req)
    {
        $list=(new Product())->getLayer1($req->layer1);
        $banner=(new Banner())->getBanner($req->apId);

        return view("front.product.list", compact("list", "banner"));
    }
}
