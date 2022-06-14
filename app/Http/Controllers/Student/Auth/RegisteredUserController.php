<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\RegisterRequest;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('student.auth.register');
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
        $data = $request->validated();
        $data['historic'] = $request->historic->store('historic');
        $data['password'] = Hash::make($request->password);
        $user = Student::create($data);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::STUDENT_HOME);
    }

    public function edit()
    {
        return view('student.profile');
    }

    public function updatePersonalData(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255, regex:/^[a-zA-Z\s]+$/'],
            'phone' => ['required', 'string', 'min:15', 'max:15'],
        ]);

        $request->historic ? $data['historic'] =  $request->historic->store('historic') : null;

        $student = Student::find(Auth::user()->id);
        $student->update($data);

        if ($student) {
            return redirect()->back()->with('success', 'Os dados de perfil foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados de perfil!');
    }

    public function updateAddress(Request $request)
    {
        $data = $request->validate([
            'city' => ['required', 'string', 'min:3', 'max:100'],
            'state' => ['required', 'string', 'min:2', 'max:2'],
            'zip_code' => ['required', 'string', 'min:9', 'max:9'],
        ]);

        $student = Student::find(Auth::user()->id);

        $student->update($data);

        if ($student) {
            return redirect()->back()->with('success', 'Os dados de endereço foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados de endereço!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $student = Student::find(Auth::user()->id);

        if (Hash::check($request->password, $student->password)) {
            $student->update([
                'password' => Hash::make($request->new_password),
            ]);

            if ($student) {
                return redirect()->back()->with('success', 'A senha foi alterada com sucesso!');
            }

            return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar alterar a senha!');
        }
    }
}
