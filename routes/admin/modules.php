<?php

use Illuminate\Support\Facades\Route;


Route::get('/',             [App\Http\Controllers\Admin\ModuleController::class,'index'   ])->name('index')->middleware("user_roles:Modules,List");
Route::post('/install',[App\Http\Controllers\Admin\ModuleController::class,'install'])->name('install')->middleware("user_roles:Modules,Install");
Route::get('/{id}',         [App\Http\Controllers\Admin\ModuleController::class,'show'    ])->name('show')->middleware("user_roles:Modules,Show");
Route::get('/create',       [App\Http\Controllers\Admin\ModuleController::class,'create'  ])->name('create')->middleware("user_roles:Modules,Create");
Route::get('/edit/{id}',    [App\Http\Controllers\Admin\ModuleController::class,'edit'    ])->name('edit')->middleware("user_roles:Modules,Edit");
Route::post('/store',       [App\Http\Controllers\Admin\ModuleController::class,'store'   ])->name('store')->middleware("user_roles:Modules,Create");
Route::post('/update/{id}', [App\Http\Controllers\Admin\ModuleController::class,'update'  ])->name('update')->middleware("user_roles:Modules,Edit");
Route::post('/destroy/{id}',[App\Http\Controllers\Admin\ModuleController::class,'destroy'])->name('destroy')->middleware("user_roles:Modules,Destroy");

