<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\RequirementRequest;
use App\Http\Requests\Student\TccRequest;
use App\Models\Professor;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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



    public function createTcc($subject_id)
    {
        $professors = Professor::all();
        $tcc = Tcc::where('student_id', Auth::user()->id)->where('subject_id', $subject_id)->first();;
        abort_if(!$tcc->subject->is_active || $tcc->stage != 'Etapa 1' ||
            $tcc->stage == 'Etapa 1' &&
            !in_array($tcc->situation, ['Cursando', 'Devolvido']), 403, 'Ação não permitida');

        return view('student.tcc.tcc', compact('professors', 'subject_id', 'tcc'));
    }

    public function storeTcc(TccRequest $request)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('subject_id', $request->subject)
            ->first();
        if ($request->coprofessor_id) {
            $request->validate([
                'coprofessor_id' => 'integer|exists:professors,id',
            ]);
        }

        $data = $request->validated();
        $data['professor_id'] = $request->professor;
        $data['student_id'] = Auth::user()->id;
        $this->deleteFiles([$tcc->file_pretcc, $tcc->term_commitment]);
        $data['file_pretcc'] = $request->file_pretcc->store('tcc');
        $data['term_commitment'] = $request->term_commitment->store('tcc');
        $data['ethics_committee'] = $request->ethics_committee == 1 ? true : false;
        $data['situation'] = 'Em análise';
        $tcc->update($data);

        if (!$tcc) {
            return back()->with('fail', 'Erro ao cadastrar TCC');
        }
        return redirect()->route('student.progress', $request->subject)->with('success', 'TCC cadastrado com sucesso!');
    }

    public function createRequirement($subject_id)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)->where('subject_id', $subject_id)->first();

        abort_if(!$tcc->subject->is_active || $tcc->stage != 'Etapa 2' ||
            $tcc->stage == 'Etapa 2' &&
            !in_array($tcc->situation, ['Cursando', 'Devolvido']), 403, 'Ação não permitida');

        return view('student.tcc.requirement', compact('subject_id', 'tcc'));
    }

    public function storeRequirement(RequirementRequest $request)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('subject_id', $request->subject)
            ->first();

        if ($tcc->ethics_committee) {
            $validate = Validator::make($request->only('result_ethic_committee'), [
                'result_ethic_committee' => 'required|file|mimes:pdf',
            ]);

            if ($validate->fails()) return back()->withErrors($validate->errors());
        }

        $data = $request->validated();


        $this->deleteFiles([
            $tcc->consent_professor, $tcc->file_tcc, $tcc->result_ethic_committee,
            $tcc->proof_article_submission, $tcc->photo
        ]);


        $data['consent_professor'] = $request->consent_professor->store('tcc');
        $data['file_tcc'] = $request->file_tcc->store('tcc');
        if ($request->result_ethic_committee)
            $data['result_ethic_committee'] = $request->result_ethic_committee->store('tcc');

        $data['proof_article_submission'] = $request->proof_article_submission ? $request->proof_article_submission->store('tcc') : null;
        $data['photo'] = $request->photo->store('public/student/photo');
        $data_members = $request->members;
        if (in_array(null, $data_members['three'])) unset($data_members['three']);
        foreach ($request->members as $key => $member) {
            if ($key != 'three' || $key == 'three' && !empty($member['accept_member'])) {
                $this->deleteFiles([$member['accept_member']]);
                $data_members[$key]['accept_member'] = $member['accept_member']->store('tcc');
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
            !in_array($tcc->situation, ['Cursando', 'Devolvido']), 403, 'Ação não permitida');

        return view('student.tcc.finish', compact('subject_id', 'tcc'));
    }

    public function storeFinish(Request $request)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('subject_id', $request->subject)
            ->first();

        $data = $request->except('_token');
        $this->deleteFiles([$tcc->final_tcc, $tcc->deposit_statement]);
        $data['final_tcc'] = $request->final_tcc->store('tcc');
        $data['deposit_statement'] = $request->deposit_statement->store('tcc');
        $data['situation'] = 'Em análise';

        $tcc->update($data);

        return $tcc ? redirect()->route('student.progress', $request->subject)->with('success', 'Arquivos enviados com sucesso!')
            : back()->with('fail', 'Erro ao enviar os arquivos');
    }

    private function deleteFiles($files)
    {
        foreach ($files as $file) {
            if ($file) Storage::delete($file);
        }
    }

    public function accompanimentTcc($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 1' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->file_pretcc), 403, 'Ação não permitida');
        $coprofessor = Professor::find($tcc->coprofessor_id);
        return view('student.tcc.accompaniment.tcc', compact('tcc', 'coprofessor'));
    }

    public function accompanimentRequirement($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 2' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->file_tcc || $tcc->stage == 'Etapa 1'), 403, 'Ação não permitida');
        $members = Json::decode($tcc->members);
        return view('student.tcc.accompaniment.requirement', compact('tcc', 'members'));
    }

    public function accompanimentFinish($tcc)
    {
        $tcc = Tcc::findOrFail($tcc);
        abort_if(($tcc->stage == 'Etapa 3' && $tcc->situation == 'Cursando' || $tcc->situation == 'Reprovado' && !$tcc->final_tcc || in_array($tcc->stage, ['Etapa 1', 'Etapa 2'])), 403, 'Ação não permitida');
        return view('student.tcc.accompaniment.finish', compact('tcc'));
    }
}
