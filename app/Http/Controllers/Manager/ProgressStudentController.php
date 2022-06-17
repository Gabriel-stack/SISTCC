<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Professor;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class ProgressStudentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($subject, $tcc)
    {
        $tcc = Tcc::with('student', 'professor')->where('subject_id', $subject)->findOrFail($tcc);
        $coprofessor = Professor::find($tcc->coprofessor_id);
        return view('manager.tcc.progress', compact('tcc', 'coprofessor'));
    }

    public function accompanimentTcc($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 1' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->file_pretcc), 403, 'No momento, essa etapa não está liberada para visualização');
        $coprofessor = Professor::find($tcc->coprofessor_id);
        return view('manager.tcc.tcc', compact('tcc', 'coprofessor'));
    }

    public function accompanimentRequirement($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 2' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->file_tcc || $tcc->stage == 'Etapa 1'), 403, 'No momento, essa etapa não está liberada para visualização');
        $members = Json::decode($tcc->members);
        return view('manager.tcc.requirement', compact('tcc', 'members'));
    }

    public function accompanimentFinish($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 3' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->final_tcc || in_array($tcc->stage, ['Etapa 1', 'Etapa 2'])), 403, 'No momento, essa etapa não está liberada para visualização');
        return view('manager.tcc.finish', compact('tcc'));
    }

    public function accompanimentReturn(Request $request)
    { // Executa ação de devolução de etapa
        $tcc = Tcc::findOrFail($request->id);
        $tcc->situation = 'devolvido';
        $tcc->message = $request->message;
        $tcc->save();

        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'A etapa foi devolvida ao aluno!')
            : redirect()->back()->with('fail', 'Ocorreu um erro ao tentar devolver a etapa ao aluno!');
    }
    public function rollbackStage(Request $request)
    {// Executa ação de retrocesso para a primeira etapa
        $tcc = Tcc::findOrFail($request->id);
        $tcc->stage = 'Etapa 1';
        $tcc->situation = 'Devolvido';
        $tcc->save();

        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'A etapa foi devolvida ao aluno!')
            : redirect()->back()->with('fail', 'Ocorreu um erro ao tentar devolver a etapa ao aluno!');
    }

    public function accompanimentValidate(Request $request)
    { // Executa ação de validação de etapa
        $tcc = Tcc::findOrFail($request->id);
        $tcc->situation = $tcc->stage == 'Etapa 3' ? 'Concluído' : 'Cursando';
        $tcc->stage = $tcc->stage == 'Etapa 1' ? 'Etapa 2' : 'Etapa 3';
        $tcc->save();
        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'A etapa foi validada!')
            : redirect()->back()->with('fail', 'Ocorreu um erro ao tentar validar a etapa!');
    }

    public function accompanimentDisapprove(Request $request)
    { // Executa ação de reprovar o aluno
        $tcc = Tcc::findOrFail($request->id);
        $tcc->situation = 'Reprovado';
        $tcc->save();
        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'O aluno foi reprovado!')
            : redirect()->back()->with('fail', 'Ocorreu um erro ao tentar validar a etapa!');
    }
}
