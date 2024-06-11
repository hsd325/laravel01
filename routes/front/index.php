<?php

use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, "index"])->middleware("info");
Route::get("/lan/{lan}", [HomeController::class, "index"])->middleware("info");
Route::get("/about/{apId}", [AboutController::class, "index"])->middleware("info");
Route::get("/line", [HomeController::class, "line"])->middleware("info");
Route::post("/about/saveImg", [AboutController::class, "saveImg"]);
Route::get("/crop", [HomeController::class, "crop"]);
Route::get("/image", [HomeController::class, "image"]);

require __DIR__."/product.php";
require __DIR__."/news.php";

