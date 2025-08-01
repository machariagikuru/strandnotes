<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // استخدام strtolower لضمان عدم اختلاف حالة الأحرف
    $userType = strtolower($request->user()->usertype);

    if ($userType === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($userType === 'instructor') {
        return redirect()->route('instructor.dashboard');
    } elseif ($userType === 'user') {
        return redirect()->route('dashboard');
    }

    return redirect('/');
}

    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
