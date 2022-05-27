<?php

namespace App\Http\Controllers\ProfessorAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\LoginRequest;
use App\Models\Professor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('professor.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        if (Professor::where('email', $request->email)->where('active', false)->first()) {
            return redirect()->route('professor.login')->with('fail', 'A conta está desativada e por isso não pode ser acessada!');
        }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::PROFESSOR_HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('professor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('professor.login');
    }
}
