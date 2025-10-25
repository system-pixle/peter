<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ----------------- SHOW LOGIN FORMS -----------------
    public function showDirectorLoginForm()
    {
        return view('auth.director-login');
    }

    public function showTeacherLoginForm()
    {
        return view('auth.teacher-login');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    // ----------------- LOGIN METHODS -----------------
    public function loginDirector(Request $request)
    {
        return $this->loginByRole($request, 'director', 'director.dashboard');
    }

    public function loginTeacher(Request $request)
    {
        return $this->loginByRole($request, 'teacher', 'teacher.dashboard');
    }

    public function loginAdmin(Request $request)
    {
        return $this->loginByRole($request, 'admin', 'admin.dashboard');
    }

    // ----------------- REUSABLE LOGIN FUNCTION -----------------
    private function loginByRole(Request $request, $role, $redirectRoute)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === $role) {
                $request->session()->regenerate();
                return redirect()->route($redirectRoute);
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Access denied for this role.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // ----------------- LOGOUT -----------------
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
