<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $products = Product::count();
        $transactions = Order::count();
        $categories = Category::count();
        $users = User::count();
        $datas = Order::with('productOrder.product.category')->latest()->paginate(10);

        return view('dashboard', compact('products', 'transactions', 'categories', 'users', 'datas'));
    }


}
