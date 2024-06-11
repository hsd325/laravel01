<?php

use App\Http\Controllers\Admin\Common\MenuController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/menu"],function(){
    Route::any("list",[MenuController::class,"list"]);
    Route::any("add",[MenuController::class,"add"]);
    Route::any("insert",[MenuController::class,"insert"]);
    Route::any("edit/{id}",[MenuController::class,"edit"]);
    Route::any("update",[MenuController::class,"update"]);
    Route::any("delete",[MenuController::class,"delete"]);
});