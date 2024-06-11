<?php

use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\News\NewsTypeController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/news"], function () {
    Route::group(["prefix" => "type"], function () {
        Route::any("list", [NewsTypeController::class, "list"]);
        Route::any("add", [NewsTypeController::class, "add"]);
        Route::any("insert", [NewsTypeController::class, "insert"]);
        Route::any("edit/{id}", [NewsTypeController::class, "edit"]);
        Route::any("update", [NewsTypeController::class, "update"]);
        Route::any("delete", [NewsTypeController::class, "delete"]);
    });

    Route::any("list", [NewsController::class, "list"]);
    Route::any("add", [NewsController::class, "add"]);
    Route::any("insert", [NewsController::class, "insert"]);
    Route::any("edit/{id}", [NewsController::class, "edit"]);
    Route::any("update", [NewsController::class, "update"]);
    Route::any("delete", [NewsController::class, "delete"]);
});
