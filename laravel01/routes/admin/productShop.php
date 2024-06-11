<?php

use App\Http\Controllers\Admin\Product\ProductShopController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/productShop"],function(){
    Route::any("list",[ProductShopController::class,"list"]);
    Route::any("add/{itemId}",[ProductShopController::class,"add"]);
    Route::any("insert",[ProductShopController::class,"insert"]);
    Route::any("edit/{itemId}/{id}",[ProductShopController::class,"edit"]);
    Route::any("update",[ProductShopController::class,"update"]);
    Route::any("delete",[ProductShopController::class,"delete"]);
});