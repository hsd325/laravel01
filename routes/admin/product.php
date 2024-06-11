<?php

use App\Http\Controllers\Admin\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/product"],function(){
    Route::any("list",[ProductController::class,"list"]);
    Route::any("add",[ProductController::class,"add"]);
    Route::any("insert",[ProductController::class,"insert"]);
    Route::any("edit/{id}",[ProductController::class,"edit"]);
    Route::any("update",[ProductController::class,"update"]);
    Route::any("delete",[ProductController::class,"delete"]);
    Route::get("word/{id}", [ProductController::class, "word"]);
    Route::get("pdf/{id?}", [ProductController::class, "pdf"]);
    Route::get("pdfList", [ProductController::class, "pdfList"]);
    Route::get("excel", [ProductController::class, "excel"]);
});