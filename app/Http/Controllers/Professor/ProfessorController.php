<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorAuth\RegisterRequest;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professors = Professor::paginate(10);

        return view('professor.professors', compact('professors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $data['active'] = true;

        $professor = Professor::create($data);

        if ($professor) {
            return redirect()->back()->with('success', 'O professor foi cadastrado com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar cadastrar o professor!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $professor = Professor::findOrFail($request->id);

        $professor->update($request->all());

        if ($professor) {
            return redirect()->back()->with('success', 'Os dados do professor foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados do professor!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $professor = Professor::findOrFail($request->id);

        // if () { // Regra de exclusão de professor.
        //     return redirect()->back()->with('fail', 'O professor não pode ser excluído porque ...!');
        // }

        $professor_id = $professor->id;

        $professor->delete();

        if ($professor_id == Auth::guard('professor')->user()->id) {
            Auth::guard('professor')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('professor.login');
        }

        if ($professor) {
            return redirect()->back()->with('success', 'O professor foi excluído com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar exlui o professor!');
    }

    public function disable(Request $request)
    {
        $professor = Professor::findOrFail($request->id);

        // if () { // Regra de desativação de professor.
        //     return redirect()->back()->with('fail', 'O professor não pode ser desativado porque ...!');
        // }

        $professor->update(['active' => false]);

        if ($professor->id == Auth::guard('professor')->user()->id) {
            Auth::guard('professor')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('professor.login');
        }

        if ($professor) {
            return redirect()->back()->with('success', 'A conta do professor foi desativada com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar desativar a conta do professor!');
    }

    public function active(Request $request)
    {
        $professor = Professor::findOrFail($request->id);

        $professor->update(['active' => true]);

        if ($professor) {
            return redirect()->back()->with('success', 'A conta do professor foi ativada com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar ativar a conta do professor!');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $professors = Professor::where('name', 'LIKE', '%' . $request->search . '%')->paginate();
        }

        $filters = $request->except('_token');

        return view('professor.professors', compact('professors', 'filters'));
    }
}
