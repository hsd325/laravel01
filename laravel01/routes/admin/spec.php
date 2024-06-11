<?php

use App\Http\Controllers\Admin\Product\SpecController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/spec"],function(){
    Route::any("add/{itemId}",[SpecController::class,"add"]);
    Route::any("insert",[SpecController::class,"insert"]);
    Route::any("edit/{itemId}/{id}",[SpecController::class,"edit"]);
    Route::any("update",[SpecController::class,"update"]);
    Route::any("delete",[SpecController::class,"delete"]);
});