<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleLoginController extends Controller
{

    public function showLoginForm($role)
    {
        $allowedRoles = ['director', 'admin', 'teacher'];

        if (!in_array($role, $allowedRoles)) {
            abort(404);
        }

        return view('auth.role-login', compact('role'));
    }

    public function login(Request $request, $role)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role !== $role) {
                Auth::logout();
                return back()->withErrors(['email' => 'You are not authorized as a ' . ucfirst($role) . '.']);
            }

            $request->session()->regenerate();
            return redirect()->route('dashboard');

                switch ($role) {
        case 'director':
            return redirect()->route('director.dashboard');
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'teacher':
            return redirect()->route('teacher.dashboard');
        default:
            return redirect()->route('dashboard');
    }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
}




    

