<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {

    }
    public function loginPage()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard.index');
        }
        return view('dashboard.auth.login');
    }

    public function login(LoginRequest $loginRequest)
    {
        if (Auth::guard('admin')->attempt($loginRequest->only(['email', 'password'], $loginRequest->has('remember')))) {
            return redirect()->route('dashboard.index');
        }
        return redirect()->back()->withErrors(['The email or password is incorrect.']);
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::logout();
            return redirect()->route('dashboard.login');
        }
        return redirect()->back();
    }
}
