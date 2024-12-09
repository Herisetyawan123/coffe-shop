<?php

use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('services')->group(function () {
//   Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::controller(ServiceController::class)->group(function(){
        Route::get('/', 'index')->name('service.index');
        Route::get('/add', 'add')->name('service.add');
        Route::get('/edit/{id}', 'edit')->name('service.edit');
        Route::post('/store', 'store')->name('service.store');
        Route::post('/update', 'update')->name('service.update');
        Route::delete('/{id}', 'delete')->name('service.delete');
    });
});