<?php

use App\Http\Controllers\Admin\Shop\ShopController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "shop"],function(){
    Route::any("list",[ShopController::class,"list"]);
    Route::any("add",[ShopController::class,"add"]);
    Route::any("insert",[ShopController::class,"insert"]);
    Route::any("edit/{id}",[ShopController::class,"edit"]);
    Route::any("update",[ShopController::class,"update"]);
    Route::any("delete",[ShopController::class,"delete"]);
});