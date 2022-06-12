<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\SubjectRequest;
use App\Models\Subject;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::where('manager_id', Auth::guard('professor')->user()->id)->get();
        $active_subject = $subjects->where('is_active', true)->first();
        $disabled_subjects = Subject::where('manager_id', Auth::guard('professor')->user()->id)
                                        ->where('is_active', false)
                                        ->paginate(10);

        return view('manager.dashboard', compact('disabled_subjects', 'active_subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        // if (Subject::where('active', true)->where('course_id', Course::where('manager_id', Auth::guard('professor')->user()->id))->first()) {
        if (Subject::where('is_active', true)->first()) {
            return back()->with('fail', 'Já possui uma turma em vigência!');
        }

        $data = $request->all();
        $data['manager_id'] = Auth::guard('professor')->user()->id;

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


    public function close(Request $request)
    {
        $subject = Subject::findOrFail($request->id);

        $tccs = Tcc::where('subject_id', $subject->id)->get();
        foreach ($tccs as $tcc) {
            if ($tcc->situation != 'Aprovado'){
                $tcc->situation = 'Reprovado';
                $tcc->save();
            }
        }

        $subject->update(['is_active' => false]);

        return $subject? redirect()->route('manager.dashboard')->with('success', 'A turma foi encerrada com sucesso!')
            :back()->with('fail', 'Ocorreu algum problema ao tentar encerrar a turma!');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $disabled_subjects = Subject::where('is_active', false)->where('class', 'LIKE', '%' . $request->search . '%')->paginate(10);
        }

        $filters = $request->except('_token');

        $subjects = Subject::where('manager_id', Auth::guard('professor')->user()->id)->get();
        $active_subject = $subjects->where('is_active', true)->first();

        return view('manager.dashboard', compact('disabled_subjects', 'active_subject', 'filters'));
    }
}
