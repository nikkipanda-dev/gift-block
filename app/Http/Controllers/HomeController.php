<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function admin()
    {
        return view('auth.admin-login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
