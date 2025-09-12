<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\GoodsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ゲストユーザーログインのルート (メールアドレス不要)
Route::get('/login/guest', [GuestLoginController::class, 'login'])->name('guest.login');

// 認証が必要な全てのルートをグループ化
Route::middleware(['auth', 'verified'])->group(function () {
    // 全ユーザーがアクセスできるページ
    Route::get('/dashboard', function () {
        return view('dashboard');
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
