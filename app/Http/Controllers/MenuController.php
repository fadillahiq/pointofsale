<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function category()
    {
        return view('menu.category');
    }

    public function product()
    {
        return view('menu.product');
    }

    public function transaction()
    {
        return view('menu.transaction');
    }

    public function invoice($no_order)
    {

        $order = Order::with('productOrder.product')->where('code', $no_order)->first();
        return view('menu.invoice', compact('order'));
    }

    public function report()
    {
        return view('menu.report');
    }

    public function user()
    {
        return view('menu.user');
    }
}
