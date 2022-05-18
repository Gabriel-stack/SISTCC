<?php

namespace App\Http\Controllers\ProfessorAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorAuth\RegisterRequest;
use App\Models\Professor;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('professor.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = Professor::create($data);

        event(new Registered($user));

        Auth::guard('professor')->login($user);

        return redirect(RouteServiceProvider::PROFESSOR_HOME);
    }
}
