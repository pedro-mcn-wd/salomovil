<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^(\\p{Lu}\\p{Ll}+\\s?)+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'email.unique' => 'Ya existe una cuenta asociada a este email.',
            'password.confirmed' => 'Las contraseñas no son iguales.'
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('client');

        event(new Registered($user));

        Auth::login($user);
        $idUser = Auth::id();

        UserProfile::create([
            'name' => $request->name,
            'surname_first' => null,
            'surname_second' => null,
            'dni' => null,
            'birthdate' => null,
            'bio' => null,
            'user_id' => $idUser,
        ]);

        return redirect(RouteServiceProvider::HOME)->with('success','¡Bienvenido!');
    }
}
