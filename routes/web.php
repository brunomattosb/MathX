<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home'])->name('home');
Route::post('/generate-excercises', [MainController::class, 'generateExcercises'])->name('generateExcercises');
Route::get('/print-exercises', [MainController::class, 'printExcercises'])->name('printExcercises');
Route::get('/export-excercises', [MainController::class, 'exportExcercises'])->name('exportExcercises');
