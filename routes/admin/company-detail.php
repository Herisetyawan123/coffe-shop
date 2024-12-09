<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/company-detail')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\CompanyDetailController::class, 'index']);
    Route::post('/', [App\Http\Controllers\Admin\CompanyDetailController::class, 'store']);
    Route::get('/create', [App\Http\Controllers\Admin\CompanyDetailController::class, 'create']);
    Route::get('/{id}', [App\Http\Controllers\Admin\CompanyDetailController::class, 'edit']);
    Route::put('/{id}', [App\Http\Controllers\Admin\CompanyDetailController::class, 'update']);
    Route::get('/delete/{id}', [App\Http\Controllers\Admin\CompanyDetailController::class, 'delete']);
    Route::post('/addphone', [App\Http\Controllers\Admin\CompanyDetailController::class, 'storePhone'], )->name('phone.store');
    Route::put('/updatephone/{id}', [App\Http\Controllers\Admin\CompanyDetailController::class, 'updatePhone'], )->name('phone.number.update');
    Route::delete('/deletephone/{id}', [App\Http\Controllers\Admin\CompanyDetailController::class, 'destroy'], )->name('phone.number.destroy');
});
