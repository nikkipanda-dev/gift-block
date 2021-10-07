<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function order()
    {
        return view('admin.orders');
    }

    public function shop()
    {
        return view('customer.index');
    }

    public function customer()
    {
        return view('customer.dashboard');
    }

    public function settings()
    {
        return view('customer.settings');
    }
}
