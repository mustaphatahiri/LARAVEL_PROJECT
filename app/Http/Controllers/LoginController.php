<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string',
        ]);

        // محاولة التحقق من قاعدة البيانات
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            switch (Auth::user()->role) {
                case 'client':
                    return redirect()->route('clients.index');
                case 'Tech':
                    return redirect()->route('tech.dashboard');
                case 'Inge':
                    return redirect()->route('enginieur.dashboard');

                default:
                    return redirect()->route('home');
            }
        }

        return back()->with('error', 'Identifiants incorrects');
    }
}
