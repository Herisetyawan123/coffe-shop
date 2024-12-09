<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetail;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        try {
            $companyDetail = CompanyDetail::all();
            return view('user.pages.about', ['getCompanyDetail' => $companyDetail]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
