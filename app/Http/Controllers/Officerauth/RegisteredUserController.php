<?php

namespace App\Http\Controllers\Officerauth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\StationOfficer;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('doctor.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Doctor::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $officer = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => 999999999,
            'address' => "Bhopal",
            'qualifications' => "MBBS",
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($officer));

        Auth::guard('doctor')->login($officer);

        return redirect(RouteServiceProvider::OFFICER_HOME);
    }
}
