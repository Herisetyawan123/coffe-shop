<?php

use App\Http\Controllers\User\DashboardController;
use App\Mail\WelcomeMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        $pcount = Product::count();
        $ccount = Category::count();
        $scount = Service::count();
        $products = Product::take(5)->get();
        return view('admin.pages.dashboard', compact(['pcount', 'ccount', 'scount', 'products']));
    });
    require __DIR__ . '/admin/company-detail.php';
    require __DIR__ . '/admin/category.php';
    require __DIR__ . '/admin/product.php';
    require __DIR__ . '/admin/service.php';
    require __DIR__ . '/admin/profile.php';
});

Route::prefix('/')->group(function(){
    Route::controller(DashboardController::class)->group(function() {
        Route::get('/', 'index')->name('home');
        Route::get('/product', 'product')->name('product');
        Route::get('/about', 'about')->name('about');
        Route::get('/product-detail/{slug}', 'productDetail')->name('product.detail');
        Route::get('/contact-us', 'aboutUs')->name('contact-us');
    });
    Route::post('/email', function (Request $request) {
        Mail::to(env('MAIL_USERNAME'))->send(new WelcomeMail($request));
        return new WelcomeMail($request);
    });
});

require __DIR__ . '/auth.php';
