<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SettingController;
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
    Route::get('/invoice/{no_order}', [MenuController::class, 'invoice'])->name('invoice');
    Route::get('/report', [MenuController::class, 'report'])->name('report');
    Route::get('/user', [MenuController::class, 'user'])->name('user')->middleware('can:index user');
    Route::get('/settings/{id}', [SettingController::class, 'profile'])->name('profile');
    Route::put('/settings/update/{id}', [SettingController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/change-password', [SettingController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password/update', [SettingController::class, 'changePasswordUpdate'])->name('change.password.update');
});
