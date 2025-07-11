<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the manager login view.
     */
    public function create(): View
    {
        return view('manager.login');
    }

    /**
     * Handle an incoming manager authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(route('manager_dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated manager session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('managers')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/manager/login');
    }
}
