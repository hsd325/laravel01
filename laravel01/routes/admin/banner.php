<?php

use App\Http\Controllers\Admin\Banner\BannerController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/banner"],function(){
    Route::any("list",[BannerController::class,"list"]);
    Route::any("add",[BannerController::class,"add"]);
    Route::any("insert",[BannerController::class,"insert"]);
    Route::any("edit/{id}",[BannerController::class,"edit"]);
    Route::any("update",[BannerController::class,"update"]);
    Route::any("delete",[BannerController::class,"delete"]);
});