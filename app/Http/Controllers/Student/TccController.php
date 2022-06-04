<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\TccRequest;
use App\Models\Professor;
use App\Models\Subject;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Json;

class TccController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subject)
    {
        $tcc = Tcc::with('subject')->where('student_id', Auth::user()->id)
            ->where('subject_id', $subject)->first();
        return view('student.tcc.progress', compact('tcc'));
    }


    public function enrollInClass(Request $request)
    {
        $subject = Subject::where('id', $request->subject)
            ->where('class_code', $request->class_code)->first();
        if (!$subject) {
            return back()->with('fail', 'Código de turma inválido');
        }

        $tcc = Tcc::create([
            'student_id' => Auth::user()->id,
            'subject_id' => $subject->id,
        ]);

        return  $tcc ? redirect()->route('student.progress', $subject->id)->with('success', 'Matrícula realizada com sucesso!')
            : back()->with('fail', 'Erro ao matricular!');
    }


    public function create($subject)
    {
        $is_active_class = Subject::where('id', $subject)->first()->is_active;
        $professors = Professor::all();
        return view('student.tcc.tcc', compact('professors', 'is_active_class'));
    }


    public function store(TccRequest $request)
    {
        $data = $request->all();
        $data['professor_id'] = $request->professor;
        $data['student_id'] = Auth::user()->id;
        $data['file_tcc'] = $request->file('file_tcc')->store('tcc/' . Auth::user()->id);
        $data['term_commitment'] = $request->file('term_commitment')->store('tcc/' . Auth::user()->id);
        $data['stage'] = 'Etapa 2';
        $tcc = Tcc::where('student_id', Auth::user()->id)
                    ->where('stage', 'Etapa 1')
                    ->first()
                    ->update($data);
        if (!$tcc) {
            return redirect()->back()->with('fail', 'Erro ao cadastrar TCC');
        }
        return redirect()->route('student.progress', 2)->with('success', 'TCC cadastrado com sucesso!');
    }



    public function requirement()
    {
        return view('student.tcc.requirement');
    }

    public function storeRequirement(Request $request)
    {
        $data = $request->except('_token');
        $data['members'] = Json::encode($request->members);
        dd([$data['members'], $request->members]);
        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('stage', 'Etapa 2')->first()->update($data);

        $tcc ? redirect()->route('student.progress', 2)->with('success', 'Requisitos cadastrados com sucesso!')
            : back()->with('fail', 'Erro ao cadastrar requisitos');
    }
}
