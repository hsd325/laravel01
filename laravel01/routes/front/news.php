<?php

use App\Http\Controllers\Front\NewsController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "news"], function(){
    Route::get("{apId}", [NewsController::class, "index"]);
    Route::post("news", [NewsController::class, "getNews"]);
    Route::get("detail/{id}", [NewsController::class, "detail"]);
});