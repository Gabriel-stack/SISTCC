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
        $tcc = Tcc::with('student', 'professor', 'subject')->where('subject_id', $subject)->findOrFail($tcc);
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
        $request->validate([
            'message' => 'required|string',
            'id' => 'required|numeric|exists:tccs,id',
        ]);

        $tcc = Tcc::findOrFail($request->id);
        $tcc->situation = 'devolvido';
        $tcc->message = $request->message;
        $tcc->save();

        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'A etapa foi devolvida ao aluno!')
            : back()->with('fail', 'Ocorreu um erro ao tentar devolver a etapa ao aluno!');
    }
    public function rollbackStage(Request $request)
    {// Executa ação de retrocesso para a primeira etapa
        $request->validate([
            'message' => 'required|string',
            'id' => 'required|numeric|exists:tccs,id',
            'stage' => 'required|in:Etapa 1,Etapa 2,Etapa 3',
        ]);

        $tcc = Tcc::findOrFail($request->id);
        $tcc->stage = $request->stage;
        $tcc->situation = 'Devolvido';
        $tcc->message = $request->message;
        $tcc->save();

        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'A etapa foi devolvida ao aluno!')
            : back()->with('fail', 'Ocorreu um erro ao tentar devolver a etapa ao aluno!');
    }

    public function accompanimentValidate(Request $request)
    { // Executa ação de validação de etapa
        $tcc = Tcc::findOrFail($request->id);
        $tcc->situation = $tcc->stage == 'Etapa 3' ? 'Concluído' : 'Cursando';
        $tcc->stage = $tcc->stage == 'Etapa 1' ? 'Etapa 2' : 'Etapa 3';
        $tcc->save();
        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'A etapa foi validada!')
            : back()->with('fail', 'Ocorreu um erro ao tentar validar a etapa!');
    }

    public function accompanimentDisapprove(Request $request)
    { // Executa ação de reprovar o aluno
        $tcc = Tcc::findOrFail($request->id);
        $tcc->situation = 'Reprovado';
        $tcc->save();
        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'O aluno foi reprovado!')
            : back()->with('fail', 'Ocorreu um erro ao tentar reprovar o aluno!');
    }

    public function accompanimentCancelDisapproval(Request $request)
    { // Executa ação de cancelar reprovação do aluno
        $tcc = Tcc::findOrFail($request->id);
        switch ($tcc->stage) {
            case 'Etapa 1':
                $tcc->file_pretcc ? $tcc->situation = 'Em análise' : $tcc->situation = 'Cursando';
                break;
            case 'Etapa 2':
                $tcc->file_tcc ? $tcc->situation = 'Em análise' : $tcc->situation = 'Cursando';
                break;
            case 'Etapa 3':
                $tcc->final_tcc ? $tcc->situation = 'Em análise' : $tcc->situation = 'Cursando';
        }
        $tcc->save();
        return $tcc ? redirect()->route('manager.show', [$tcc->subject_id, $tcc->id])->with('success', 'O aluno teve a sua reprovação cancelada!')
            : back()->with('fail', 'Ocorreu um erro ao tentar cancelar a reprovação do aluno!');
    }
}
