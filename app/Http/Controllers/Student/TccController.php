<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\TccRequest;
use App\Models\Professor;
use App\Models\Subject;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            ->where('subject_id', $subject)
            ->first();
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


    public function createTcc($subject_id)
    {
        $professors = Professor::all();
        $tcc = Tcc::where('student_id', Auth::user()->id)->where('subject_id', $subject_id)->first();;
        abort_if(!$tcc->subject->is_active || $tcc->stage != 'Etapa 1' ||
            $tcc->stage == 'Etapa 1' &&
            !in_array($tcc->situation, ['Cursando', 'Devolvido']), 401);

        return view('student.tcc.tcc', compact('professors', 'subject_id', 'tcc'));
    }

    public function storeTcc(TccRequest $request)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('subject_id', $request->subject)
            ->first();

        $data = $request->except('_token');
        $data['professor_id'] = $request->professor;
        $data['student_id'] = Auth::user()->id;
        $this->deleteFiles([$tcc->file_pretcc, $tcc->term_commitment]);
        $data['file_pretcc'] = $request->file_pretcc->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        $data['term_commitment'] = $request->term_commitment->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        $data['ethics_committee'] = $request->ethics_committee == 1 ? true : false;
        $data['situation'] = 'Em análise';

        $tcc->update($data);

        if (!$tcc) {
            return redirect()->back()->with('fail', 'Erro ao cadastrar TCC');
        }
        return redirect()->route('student.progress', $request->subject)->with('success', 'TCC cadastrado com sucesso!');
    }

    public function createRequirement($subject_id)
    {

        $tcc = Tcc::where('student_id', Auth::user()->id)->where('subject_id', $subject_id)->first();
        abort_if(!$tcc->subject->is_active || $tcc->stage != 'Etapa 2' ||
            $tcc->stage == 'Etapa 2' &&
            !in_array($tcc->situation, ['Cursando', 'Devolvido']), 401);

        $ethics_committee = Tcc::where('student_id', Auth::user()->id)
            ->where('subject_id', $subject_id)
            ->first()->ethics_committee;



        return view('student.tcc.requirement', compact('ethics_committee', 'subject_id', 'tcc'));
    }

    public function storeRequirement(Request $request)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('subject_id', $request->subject)
            ->first();

        $data = $request->except('_token');
        $this->deleteFiles([$tcc->consent_professor, $tcc->file_tcc, $tcc->result_ethic_commitee, $tcc->proof_article_submission, $tcc->photo]);
        $data['consent_professor'] = $request->consent_professor->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        $data['file_tcc'] = $request->file_tcc->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        if ($request->result_ethic_commitee)
            $data['result_ethic_commitee'] = $request->result_ethic_commitee->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        $data['proof_article_submission'] = $request->proof_article_submission->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        $data['photo'] = $request->photo->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        $data_members = $request->members;
        if (in_array(null, $data_members['three'])) unset($data_members['three']);
        foreach ($request->members as $key => $member) {
            if ($key != 'three' || $key == 'three' && !empty($member['accept_member'])) {
                $this->deleteFiles([$member['accept_member']]);
                $data_members[$key]['accept_member'] = $member['accept_member']->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
            }
        }
        $data['members'] = Json::encode($data_members);
        $data['situation'] = 'Em análise';

        $tcc->update($data);

        return $tcc ? redirect()->route('student.progress', $request->subject)->with('success', 'Requerimento cadastrado com sucesso!')
            : back()->with('fail', 'Erro ao cadastrar o requerimento');
    }

    public function createFinish($subject_id)
    {
        $tcc = Tcc::with('subject')->where('student_id', Auth::user()->id)->where('subject_id', $subject_id)->first();
        abort_if(!$tcc->subject->is_active || $tcc->stage != 'Etapa 3' ||
            $tcc->stage == 'Etapa 3' &&
            !in_array($tcc->situation, ['Cursando', 'Devolvido']), 401);

        return view('student.tcc.finish', compact('subject_id', 'tcc'));
    }

    public function storeFinish(Request $request)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('subject_id', $request->subject)
            ->first();

        $data = $request->except('_token');
        $this->deleteFiles([$tcc->final_tcc, $tcc->deposit_statement]);
        $data['final_tcc'] = $request->final_tcc->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        $data['deposit_statement'] = $request->deposit_statement->store('tcc/subject_' . $request->subject . '/student_' . Auth::user()->id);
        $data['situation'] = 'Em análise';

        $tcc->update($data);

        return $tcc ? redirect()->route('student.progress', $request->subject)->with('success', 'Arquivos enviados com sucesso!')
            : back()->with('fail', 'Erro ao enviar os arquivos');
    }

    private function deleteFiles($files)
    {
        foreach ($files as $file) {
            if($file) Storage::delete($file);
        }
    }

    public function accompanimentTcc($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 1' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->file_pretcc), 401);
        $coprofessor = Professor::find($tcc->coprofessor_id);
        return view('student.tcc.accompaniment.tcc', compact('tcc', 'coprofessor'));
    }

    public function accompanimentRequirement($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 2' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->file_tcc || $tcc->stage == 'Etapa 1'), 401);
        $members = Json::decode($tcc->members);
        return view('student.tcc.accompaniment.requirement', compact('tcc', 'members'));
    }

    public function accompanimentFinish($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 3' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->final_tcc || in_array($tcc->stage, ['Etapa 1', 'Etapa 2'])), 401);
        return view('student.tcc.accompaniment.finish', compact('tcc'));
    }
}
