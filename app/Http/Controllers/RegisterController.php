<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // عرض نموذج التسجيل
    public function show()
    {
        return view('auth.register');
    }

    // معالجة البيانات المُرسلة من نموذج التسجيل
    public function register(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirmPass' => 'required|same:password',
            'role' => 'required|in:client,Tech,Inge',
        ]);

        // إنشاء المستخدم
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // تسجيل الدخول مباشرة بعد التسجيل
        return redirect()->route('login')->with('success', 'Compte créé avec succès. Connectez-vous.');

        // توجيه المستخدم حسب الدور
        switch ($user->role) {
            case 'client':
                return redirect()->route('clients.index');
            case 'Tech':
                return redirect('/tech-dashboard');
            case 'Inge':
                return redirect('/engineer-dashboard');
            default:
                return redirect()->route('home');
        }
    }
}
