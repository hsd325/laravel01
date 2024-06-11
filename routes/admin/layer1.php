<?php

use App\Http\Controllers\Admin\Product\Layer1Controller;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/layer1"],function(){
    Route::any("list",[Layer1Controller::class,"list"]);
    Route::any("add",[Layer1Controller::class,"add"]);
    Route::any("insert",[Layer1Controller::class,"insert"]);
    Route::any("edit/{id}",[Layer1Controller::class,"edit"]);
    Route::any("update",[Layer1Controller::class,"update"]);
    Route::any("delete",[Layer1Controller::class,"delete"]);
});