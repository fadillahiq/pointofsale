<?php

namespace App\Http\Controllers;

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
}
