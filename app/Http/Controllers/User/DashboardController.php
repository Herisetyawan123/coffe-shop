<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CompanyDetail;
use App\Models\ContactPhone;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        try {
            $services = Service::all();
            $products = Product::with('category')->latest()->get();
            $categories = Category::all();
            $companyDetails = CompanyDetail::all();
            $user = User::first();
            $phoneNumber = ContactPhone::all();
            return view('user.pages.index', [
                'getService' => $services,
                'getProduct' => $products,
                'getCategory' => $categories,
                'getDetailCompany' => $companyDetails,
                'user' => $user,
                'phoneNumber' => $phoneNumber
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function product()
    {
        $products = Product::with('category')->get();
        $categories = Category::get();
        return view('user.pages.product', compact(['products', 'categories']));
    }

    public function productDetail($slug)
    {
        $user = User::first();
        $phoneNumber = ContactPhone::all();
        $product = Product::where('slug', $slug)->first();
        return view('user.pages.product-detail', compact('product', 'user', 'phoneNumber'));
    }

    public function about()
    {
        try {
            $companyDetail = CompanyDetail::all();
            return view('user.pages.about', ['getCompanyDetail' => $companyDetail]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function aboutUs()
    {
        $user = User::first();
        $phoneNumber = ContactPhone::all();
        return view('user.pages.contact-us', compact('user', 'phoneNumber'));
    }
}
