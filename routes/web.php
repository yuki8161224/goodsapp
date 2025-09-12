<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\GoodsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// ゲストユーザーログインのルート (メールアドレス不要)
Route::get('/login/guest', [GuestLoginController::class, 'login'])->name('guest.login');

// 認証が必要な全てのルートをグループ化
Route::middleware(['auth', 'verified'])->group(function () {
    // ユーザーの役割に基づいてアクセス先を振り分け
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return view('dashboard');
        } elseif (Auth::user()->role === 'user') {
            return view('guestdashboard');
        }
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 管理ユーザー専用のルート
    Route::middleware(['admin'])->group(function () {
        Route::resource('goods', GoodsController::class);
    });
});

require __DIR__ . '/auth.php';
