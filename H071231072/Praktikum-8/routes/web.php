<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pageController;


Route::get('/',[pageController::class,'home'])->name('home');

Route::get('/about',[pageController::class,'about'])->name('about');

Route::get('/Gallery',[pageController::class,'Gallery'])->name('Gallery');
Route::get('/contact',[pageController::class,'contact'])->name('contact');