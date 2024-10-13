<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::resource('arsip', ArsipController::class);
Route::get('/arsip/create', [ArsipController::class, 'create'])->name('arsip.create');
Route::post('/arsip/store', [ArsipController::class, 'store'])->name('arsip.store');
Route::delete('/arsip/{id}', [App\Http\Controllers\ArsipController::class, 'destroy'])->name('arsip.destroy');
