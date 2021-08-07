<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false
]);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'menu', 'middleware' => 'auth'], function() {
    Route::get('/category', [MenuController::class, 'category'])->name('category');
    Route::get('/product', [MenuController::class, 'product'])->name('product');
    Route::get('/transaction', [MenuController::class, 'transaction'])->name('transaction');
});
