<?php

use App\Http\Controllers\Admin\Common\LabelController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/label"],function(){
    Route::any("list",[LabelController::class,"list"]);
    Route::any("add",[LabelController::class,"add"]);
    Route::any("insert",[LabelController::class,"insert"]);
    Route::any("edit/{id}",[LabelController::class,"edit"]);
    Route::any("update",[LabelController::class,"update"]);
    Route::any("delete",[LabelController::class,"delete"]);
});