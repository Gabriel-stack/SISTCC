<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ProfessorRequest;
use App\Models\Manager;
use App\Models\Professor;
use App\Models\Tcc;
use Illuminate\Http\Request;

class professorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professors = Professor::paginate(10);

        return view('manager.professors', compact('professors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessorRequest $request)
    {
        $data = $request->all();
        $data['active'] = true;

        $professor = Professor::create($data);

        if ($professor) {
            return redirect()->back()->with('success', 'O orientador foi cadastrado com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar cadastrar o orientador!');
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
            return redirect()->back()->with('success', 'Os dados do orientador foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados do orientador!');
    }

    public function destroy(Request $request)
    {
        $professor = Professor::findOrFail($request->id);

        if (Tcc::where('professor_id', $professor->id)->first() || Manager::where('professor_id', $professor->id)->first()) { // Regra de exclusão de orientador.
            return redirect()->back()->with('fail', 'O orientador não pode ser excluído!');
        }

        $professor->delete();

        if ($professor) {
            return redirect()->back()->with('success', 'O orientador foi excluído com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar exlui o orientador!');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $professors = Professor::where('name', 'LIKE', '%' . $request->search . '%')->paginate(10);
        }

        $filters = $request->except('_token');

        return view('manager.professors', compact('professors', 'filters'));
    }
}
