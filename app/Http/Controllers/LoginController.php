<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show() {
        return Inertia::render('Login', [
        ]);
    }

    public function authenticate(Request $request)
    {

        if(Auth::attempt($request->all())){
            return to_route('home');
        }

        return redirect()->route('login')->with('message', 'Username atau password salah');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return to_route('login');
    }

    public function showLoginAdmin(Request $request) {

        return Inertia::render('LoginAdmin', [
        ]);
    }
    
    public function loginAdmin(Request $request) {
        $user = User::where('email', $request->email)->first();

        if($user->role == 'user') {
            return to_route('login');
        }

        if(Auth::attempt($request->all())){
            return to_route('dashboard');
        }

        return to_route('login');

    }
    
}