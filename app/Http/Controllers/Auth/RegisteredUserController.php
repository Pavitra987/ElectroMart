<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
          'password' => [
    'required',
    'string',
    'min:8',
    'confirmed',
    'regex:/[A-Z]/',
    'regex:/[a-z]/',
    'regex:/[0-9]/',
    'regex:/[^a-zA-Z0-9]/',
],
    [
[
    'password.required' => 'Password is required.',
    'password.min' => 'Password must contain at least 8 characters.',
    'password.confirmed' => 'Password confirmation does not match.',
    'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
]


    ]

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('storefront.home', absolute: false));
    }
}
