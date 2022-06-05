<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\TccRequest;
use App\Models\Professor;
use App\Models\Subject;
use App\Models\Tcc;
use Illuminate\Http\Request;
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
        $tcc = Tcc::where('student_id', Auth::user()->id)->where('subject_id', $subject_id)->first();
        return view('student.tcc.tcc', compact('professors', 'subject_id', 'tcc'));
    }

    public function storeTcc(TccRequest $request)
    {
        $data = $request->except('_token');
        $subject_id = Tcc::where('student_id', Auth::user()->id)->where('stage', 'Etapa 1')->first()->subject_id;
        $data['professor_id'] = $request->professor;
        $data['student_id'] = Auth::user()->id;
        $data['file_pretcc'] = $request->file_pretcc->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        $data['term_commitment'] = $request->term_commitment->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        $data['ethics_committee'] = $request->ethics_committee == 1 ? true : false;
        $data['situation'] = 'Em análise';

        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('stage', 'Etapa 1')
            ->first()
            ->update($data);

        if (!$tcc) {
            return redirect()->back()->with('fail', 'Erro ao cadastrar TCC');
        }
        return redirect()->route('student.progress', $subject_id)->with('success', 'TCC cadastrado com sucesso!');
    }

    public function createRequirement($subject_id)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)->where('subject_id', $subject_id)->first();
        $ethics_committee = Tcc::where('student_id', Auth::user()->id)
            ->where('subject_id', $subject_id)
            ->first()->ethics_committee;

        return view('student.tcc.requirement', compact('ethics_committee', 'subject_id', 'tcc'));
    }

    public function storeRequirement(Request $request)
    {
        $data = $request->except('_token');
        $subject_id = Tcc::where('student_id', Auth::user()->id)->where('stage', 'Etapa 2')->first()->subject_id;
        $data['consert_professor'] = $request->consert_professor->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        $data['file_tcc'] = $request->file_tcc->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        if ($request->result_ethic_commitee)
            $data['result_ethic_commitee'] = $request->result_ethic_commitee->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        $data['proof_article_submission'] = $request->proof_article_submission->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        $data['photo'] = $request->photo->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        $data_members = $request->members;
        foreach ($request->members as $key => $member) {
            if ($key != 'three' || $key == 'three' && !empty($member['accept_member'])) {
                $data_members[$key]['accept_member'] = $member['accept_member']->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
            }
        }
        $data['members'] = Json::encode($data_members);
        $data['situation'] = 'Em análise';

        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('stage', 'Etapa 2')->first()->update($data);

        return $tcc ? redirect()->route('student.progress', $subject_id)->with('success', 'Requerimento cadastrado com sucesso!')
            : back()->with('fail', 'Erro ao cadastrar o requerimento');
    }

    public function createFinish($subject_id)
    {
        $tcc = Tcc::where('student_id', Auth::user()->id)->where('subject_id', $subject_id)->first();
        return view('student.tcc.finish', compact('subject_id', 'tcc'));
    }

    public function storeFinish(Request $request)
    {
        $data = $request->except('_token');
        $subject_id = Tcc::where('student_id', Auth::user()->id)->where('stage', 'Etapa 3')->first()->subject_id;
        $data['final_tcc'] = $request->final_tcc->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        $data['deposit_statement'] = $request->deposit_statement->store('tcc/subject_' . $subject_id . '/student_' . Auth::user()->id);
        $data['situation'] = 'Em análise';

        $tcc = Tcc::where('student_id', Auth::user()->id)
            ->where('stage', 'Etapa 3')->first()->update($data);

        return $tcc ? redirect()->route('student.progress', $subject_id)->with('success', 'Arquivos enviados com sucesso!')
            : back()->with('fail', 'Erro ao enviar os arquivos');
    }
}
