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
        return view('officer.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if(Auth::guard('officer')->user()->is_verified==0 || Auth::guard('officer')->user()->status==0)
        {
            Auth::guard('officer')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            Alert::error('Not Verified','Your account is not verified yet');
            
            return redirect()->route('officer.login');
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::OFFICER_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('officer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
