<?php

use Illuminate\Support\Facades\Route;

Route::get("/",[\App\Http\Controllers\Admin\TemplateHooksComponentWidgetController::class,"index"])->name("index");

Route::get("/create",[\App\Http\Controllers\Admin\TemplateHooksComponentWidgetController::class,"create"])->name("create");
Route::get("/edit/{id?}",[\App\Http\Controllers\Admin\TemplateHooksComponentWidgetController::class,"edit"])->name("edit");
Route::post("/store",[\App\Http\Controllers\Admin\TemplateHooksComponentWidgetController::class,"store"])->name("store");
Route::post("/update/{id?}",[\App\Http\Controllers\Admin\TemplateHooksComponentWidgetController::class,"update"])->name("update");
Route::post("/destroy/{id}",[\App\Http\Controllers\Admin\TemplateHooksComponentWidgetController::class,"destroy"])->name("destroy");










