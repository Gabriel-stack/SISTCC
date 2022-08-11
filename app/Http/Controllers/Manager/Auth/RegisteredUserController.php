<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\RegisterRequest;
use App\Models\Manager;
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
        return view('manager.auth.register');
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
        $data['user_type'] = 'professor';

        $user = Manager::create($data);

        event(new Registered($user));

        Auth::guard('professor')->login($user);

        return redirect(RouteServiceProvider::PROFESSOR_HOME);
    }

    public function edit()
    {
        return view('manager.profile');
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

        $manager = Manager::find(Auth::guard('professor')->user()->id);

        if (Hash::check($request->password, $manager->password)) {
            $manager->update([
                'password' => Hash::make($request->new_password),
            ]);

            if ($manager) {
                return redirect()->back()->with('success', 'A senha foi alterada com sucesso!');
            }

            return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar alterar a senha!');
        }
    }
}
