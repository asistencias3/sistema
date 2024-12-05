<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
        // Autentica al usuario
        $request->authenticate();

        // Regenera la sesión para prevenir ataques de fijación de sesión
        $request->session()->regenerate();

        // Obtiene al usuario autenticado
        $usuario = Auth::user();

        // Guarda los datos del usuario en la sesión
        $request->session()->flash('usuario', 
            [
            'id' => $usuario->id,
            'nombre' => $usuario->nombre,
            'email' => $usuario->email,
            'rol' => $usuario->rol
        ]);

        // Redirige a la página deseada después del login
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Cierra la sesión del usuario
        Auth::guard('web')->logout();

        // Invalida la sesión y regenera el token para evitar CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirige al inicio después de cerrar sesión
        return redirect('/');
    }
}
