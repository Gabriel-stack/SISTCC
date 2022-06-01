<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Tcc;
use Illuminate\Http\Request;

class ProgressStudentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($subject, $tcc)
    {
        return view('manager.progress', [
            'tcc' => Tcc::with('student', 'professor')->where('subject_id', $subject)->findOrFail($tcc),
        ]);
    }

    public function accompanimentTcc($tcc){
        $tcc = Tcc::findOrFail($tcc);
        return view('manager.tcc.tcc', compact('tcc'));
    }

    public function accompanimentRequirement($tcc){
        $tcc = Tcc::findOrFail($tcc);
        return view('manager.tcc.requirement', compact('tcc'));
    }

    public function accompanimentFinish($tcc){
        $tcc = Tcc::findOrFail($tcc);
        return view('manager.tcc.finish', compact('tcc'));
    }

    public function accompanimentReturn($tcc){
        $tcc = Tcc::findOrFail($tcc);
        // Executa ação de devolução de etapa
        return $tcc ? redirect()->route('manager.subject.student', [$tcc->subject_id, $tcc->id])->with('success', 'A etapa foi devolvida ao aluno com sucesso!')
                    : redirect()->route('manager.subject.student', [$tcc->subject_id, $tcc->id])->with('fail', 'Ocorreu um erro ao tentar devolver a etapa ao aluno!');
    }

    public function accompanimentValidate($tcc){
        $tcc = Tcc::findOrFail($tcc);
        // Executa ação de validação de etapa
        return $tcc ? redirect()->route('manager.subject.student', [$tcc->subject_id, $tcc->id])->with('success', 'A etapa foi validada com sucesso!')
                    : redirect()->route('manager.subject.student', [$tcc->subject_id, $tcc->id])->with('fail', 'Ocorreu um erro ao tentar validar a etapa!');
    }
}
