<?php

use App\Http\Controllers\Admin\Product\PhotoController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/photo"],function(){
    //Route::any("list",[PhotoController::class,"list"]);
    Route::any("add/{itemId}",[PhotoController::class,"add"]);
    Route::any("insert",[PhotoController::class,"insert"]);
    //Route::any("edit/{itemId}/{id}",[PhotoController::class,"edit"]);
    Route::any("update",[PhotoController::class,"update"]);
    Route::any("delete",[PhotoController::class,"delete"]);
});