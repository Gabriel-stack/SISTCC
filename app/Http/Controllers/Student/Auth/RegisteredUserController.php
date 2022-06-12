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
        $data = $request->all();
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
        $request->validate([
            'name' => ['required', 'string', 'max:255, regex:/^[a-zA-Z\s]+$/'],
        ],);

        $student = Student::find(Auth::user()->id);

        $student->update($request->all());

        if ($student) {
            return redirect()->back()->with('success', 'Os dados de perfil foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados de perfil!');
    }

    public function updateAddress(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255, regex:/^[a-zA-Z\s]+$/'],
        // ],);

        $student = Student::find(Auth::user()->id);

        $student->update($request->all());

        if ($student) {
            return redirect()->back()->with('success', 'Os dados de endereço foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados de endereço!');
    }

    public function updateTcc(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255, regex:/^[a-zA-Z\s]+$/'],
        // ],);

        $student = Student::find(Auth::user()->id);

        $student->update($request->all());

        if ($student) {
            return redirect()->back()->with('success', 'Os dados de TCC foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados de TCC!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
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
