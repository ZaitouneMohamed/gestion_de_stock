<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/admin')->with([
                "success" => __("welcome to Admin Dashboard"),
            ]);
        } else {
            return redirect()->back()->with([
                "error" => __('Invalid credentials')
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
