<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class,'index']);

Route::resource('Product', ProductController::class);
Route::resource('Category', CategoriesController::class);
Route::resource('inventoryLog', InventoryLogController::class);