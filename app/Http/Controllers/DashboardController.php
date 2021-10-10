<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function adminProd()
    {
        return view('admin.products');
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

    public function cart()
    {
        return view('customer.cart');
    }

    public function customerProd()
    {
        $product = Product::find(10);

        // dump($product);

        return view('customer.products');
    }

    public function settings()
    {
        return view('customer.settings');
    }
}
