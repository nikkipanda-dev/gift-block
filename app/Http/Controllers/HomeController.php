<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('index');
    }

    public function admin()
    {
        return view('admin.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
