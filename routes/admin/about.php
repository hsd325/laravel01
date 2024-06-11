<?php

use App\Http\Controllers\Admin\About\AboutAdvanceController;
use App\Http\Controllers\Admin\About\AboutContentController;
use App\Http\Controllers\Admin\About\AboutController;
use App\Http\Controllers\Admin\About\AboutNoteController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/about"], function () {
    Route::group(["prefix" => "note"], function () {
        Route::any("list", [AboutNoteController::class, "list"]);
        Route::any("add", [AboutNoteController::class, "add"]);
        Route::any("insert", [AboutNoteController::class, "insert"]);
        Route::any("edit/{id}", [AboutNoteController::class, "edit"]);
        Route::any("update", [AboutNoteController::class, "update"]);
        Route::any("delete", [AboutNoteController::class, "delete"]);
    });

    Route::group(["prefix" => "advance"], function () {
        Route::any("list", [AboutAdvanceController::class, "list"]);
        Route::any("add", [AboutAdvanceController::class, "add"]);
        Route::any("insert", [AboutAdvanceController::class, "insert"]);
        Route::any("edit/{id}", [AboutAdvanceController::class, "edit"]);
        Route::any("update", [AboutAdvanceController::class, "update"]);
        Route::any("delete", [AboutAdvanceController::class, "delete"]);
    });

    Route::group(["prefix" => "about"], function () {
        Route::any("list", [AboutController::class, "list"]);
        Route::any("add", [AboutController::class, "add"]);
        Route::any("insert", [AboutController::class, "insert"]);
        Route::any("edit/{id}", [AboutController::class, "edit"]);
        Route::any("update", [AboutController::class, "update"]);
        Route::any("delete", [AboutController::class, "delete"]);
    });

    Route::group(["prefix" => "content"], function () {
        Route::any("list", [AboutContentController::class, "list"]);
        Route::any("add", [AboutContentController::class, "add"]);
        Route::any("insert", [AboutContentController::class, "insert"]);
        Route::any("edit/{id}", [AboutContentController::class, "edit"]);
        Route::any("update", [AboutContentController::class, "update"]);
        Route::any("delete", [AboutContentController::class, "delete"]);
    });
});
