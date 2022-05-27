<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::paginate(10);

        return view('professor.subjects', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        if (Subject::where('active', '1')->first()) {
            return back()->with('fail', 'Você já possui uma turma ativa!');
        }
        
        $data = $request->all();
        $subject = Subject::create($data);

        return $subject ? back()->with('success', 'A turma foi criada com sucesso!') 
                : back()->with('fail', 'Ocorreu algum problema ao tentar criar a turma!');
         
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
        $subject = Subject::findOrFail($request->id);

        $subject->update($request->all());

        return $subject? back()->with('success', 'Os dados da turma foram alterados com sucesso!')
            :back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados da turma!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subject = Subject::findOrFail($request->id);

        if (now()->gte($subject->start_date)) { // Regra de exclusão de turma.
            return redirect()->back()->with('fail', 'A turma não pode ser excluída porque o semestre já está em andamento!');
        }

        $subject->delete();

        return $subject ? back()->with('success', 'A turma foi excluída com sucesso!')
                        : back()->with('fail', 'Ocorreu algum problema ao tentar excluir a turma!');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $subjects = Subject::where('class', 'LIKE', '%' . $request->search . '%')->paginate(10);
        }

        $filters = $request->except('_token');

        return view('professor.subjects', compact('subjects', 'filters'));
    }
}
