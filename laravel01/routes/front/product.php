<?php

use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "product"],function(){
    Route::get("detail/{id}",[ProductController::class,"detail"]);
    Route::get("list/{apId}/{layer1}",[ProductController::class,"list"]);

});