<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

require __DIR__."/about.php";
require __DIR__."/banner.php";
require __DIR__."/label.php";
require __DIR__."/layer1.php";
require __DIR__."/menu.php";
require __DIR__."/news.php";
require __DIR__."/photo.php";
require __DIR__."/product.php";
require __DIR__."/productShop.php";
require __DIR__."/shop.php";
require __DIR__."/spec.php";

Route::group(["middleware" => "info", "prefix" => "admin"], function(){
    Route::any("/",[AdminController::class, "index"]);
    Route::any("login",[AdminController::class, "login"]);
    Route::any("home/{lan?}",[AdminController::class, "home"])->middleware("manager");
    Route::any("logout",[AdminController::class, "logout"]);
});