<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
  Route::get('/', [ProductController::class, 'index'])->name('products.index');
  Route::post('/add', [ProductController::class, 'store'])->name('product.store');
  Route::put('/update/{slug}', [ProductController::class, 'update'])->name('product.update');
  Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::prefix('transaksi')->group(function () {
  Route::get('/', [TransactionController::class, 'index'])->name('transaksi.index');
  Route::post('/add', [TransactionController::class, 'store'])->name('transaction.store');
  Route::get('/history', [TransactionController::class, 'history'])->name('transaksi.history');
});