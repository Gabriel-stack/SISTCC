<?php

namespace App\Http\Controllers\ProfessorAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorAuth\RegisterRequest;
use App\Models\Professor;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
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

    public function edit()
    {
        return view('professor.profile');
    }

    public function updatePersonalData(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255, regex:/^[a-zA-Z\s]+$/'],
        ],);

        $professor = Professor::find(Auth::guard('professor')->user()->id);

        $professor->update($request->all());

        if ($professor) {
            return redirect()->back()->with('success', 'Os dados de perfil foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados de perfil!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $professor = Professor::find(Auth::guard('professor')->user()->id);

        if (Hash::check($request->password, $professor->password)) {
            $professor->update([
                'password' => Hash::make($request->new_password),
            ]);

            if ($professor) {
                return redirect()->back()->with('success', 'A senha foi alterada com sucesso!');
            }

            return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar alterar a senha!');
        }
    }
}
