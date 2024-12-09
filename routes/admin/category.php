<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/categories')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/{slug}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{slug}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
});