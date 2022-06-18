<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
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
        $active_class = Subject::where('is_active', true)->first() ?? false;

        $inside = $active_class ? Tcc::with('subject')->where('subject_id', $active_class->id)
            ->where('student_id', Auth::user()->id)->first() : null;

        $tccs = Tcc::with('subject')->where('student_id', Auth::user()->id)
            ->whereRelation('subject', 'is_active', '=', false)->orderBy('situation', 'asc')->get();

        return view('student.dashboard', compact('active_class', 'inside', 'tccs'));
    }

    public function enrollInClass(Request $request)
    {
        $subject = Subject::where('class_code', $request->code)
            ->where('is_active', true)
            ->first();

        if (!$subject) {
            return back()->with('fail', 'Código de turma inválido');
        }

        $tcc = Tcc::create([
            'student_id' => Auth::user()->id,
            'subject_id' => $subject->id,
        ]);

        return $tcc ? redirect()->route('student.progress', $subject->id)->with('success', 'Matrícula realizada com sucesso!')
            : back()->with('fail', 'Erro ao matricular!');
    }
}
