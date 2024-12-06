<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryLogController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('inventory-logs', InventoryLogController::class)->except(['edit', 'update', 'destroy']);
Route::delete('/inventory-logs/{log}', [InventoryLogController::class, 'destroy'])->name('inventory-logs.destroy');
