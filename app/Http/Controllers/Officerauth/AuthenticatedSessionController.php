<?php

namespace App\Http\Controllers\Officerauth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Officerauth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('doctor.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // if(Auth::guard('doctor')->user()->is_verified==0 || Auth::guard('doctor')->user()->status==0)
        // {
        //     Auth::guard('doctor')->logout();
            
        //     Alert::error('Not Verified','Your account is not verified yet');
            
        //     return redirect()->route('doctor.login');
        // }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::OFFICER_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
