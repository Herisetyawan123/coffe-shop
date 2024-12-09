<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(ProfileController::class)->group(function(){
    Route::get('/admin/profile', 'index')->name('admin.profile');
    Route::get('/admin/profile/edit', 'edit')->name('admin.profile.edit');
    Route::post('/admin/profile/update', 'update')->name('admin.profile.update');
    Route::post('/admin/profile/reset', 'reset')->name('admin.profile.reset');
});