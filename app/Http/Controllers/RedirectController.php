<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $roleUser = \Auth::user()->roles()->pluck('name')[0];
        if($roleUser == 'customer'){
            return redirect('/customer/dashboard');
        } elseif ($roleUser == 'admin'){
            return redirect('/admin/dashboard');
        }
        else {
            return redirect('/login');
        }
    }
}
