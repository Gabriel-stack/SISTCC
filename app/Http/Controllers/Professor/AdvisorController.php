<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\AdvisorRequest;
use App\Models\Advisor;
use Illuminate\Http\Request;

class AdvisorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $advisors = Advisor::paginate(10);

        return view('professor.advisors', compact('advisors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvisorRequest $request)
    {
        $data = $request->all();
        $data['active'] = true;

        $advisor = Advisor::create($data);

        if ($advisor) {
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
        $advisor = Advisor::findOrFail($request->id);

        $advisor->update($request->all());

        if ($advisor) {
            return redirect()->back()->with('success', 'Os dados do orientador foram alterados com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados do orientador!');
    }

    public function destroy(Request $request)
    {
        $advisor = Advisor::findOrFail($request->id);

        // if (Tcc::where('advisor_id', $advisor->id)->first()) { // Regra de exclusão de orientador.
        //     return redirect()->back()->with('fail', 'O orientador não pode ser excluído porque está associado à algum reistro de aluno!');
        // }

        $advisor->delete();

        if ($advisor) {
            return redirect()->back()->with('success', 'O orientador foi excluído com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar exlui o orientador!');
    }

    public function disable(Request $request)
    {
        $advisor = Advisor::findOrFail($request->id);

        // if (Tcc::where('advisor_id', $advisor->id)->first()) { // Regra de desativação de orientador.
        //     return redirect()->back()->with('fail', 'O orientador não pode ser desativado porque está orientando algum aluno!');
        // }

        $advisor->update(['active' => false]);

        if ($advisor) {
            return redirect()->back()->with('success', 'O orientador foi desativado com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar desativar o orientador!');
    }

    public function active(Request $request)
    {
        $advisor = Advisor::findOrFail($request->id);

        $advisor->update(['active' => true]);

        if ($advisor) {
            return redirect()->back()->with('success', 'O orientador foi ativado com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar ativar o orientador!');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $advisors = Advisor::where('name', 'LIKE', '%' . $request->search . '%')->paginate();
        }

        $filters = $request->except('_token');

        return view('professor.advisors', compact('advisors', 'filters'));
    }
}
