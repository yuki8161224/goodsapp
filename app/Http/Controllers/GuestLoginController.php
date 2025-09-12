<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class GuestLoginController extends Controller
{
    public function login()
    {
        $guestUser = User::create([
            'name' => 'Guest_' . Str::random(8),
            'email' => 'guest_' . Str::random(8) . '@example.com',
            'password' => bcrypt(Str::random(12)),
            'role' => 'user',
        ]);

        Auth::login($guestUser);

        return redirect('/dashboard');
    }
}
