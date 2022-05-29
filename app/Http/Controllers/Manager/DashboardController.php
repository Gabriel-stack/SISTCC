<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Professor;
use App\Models\Student;
use App\Models\StudentHistory;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        $professors = Professor::all();
        $subject = Subject::where('manager_id', Auth::guard('professor')->user()->id)->first();
        Auth::guard('professor')->user()->name = Professor::find(Auth::guard('professor')->user()->id)->name;

        return view('manager.dashboard', compact('students', 'professors', 'subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $student = Student::findOrFail($request->student);

        return view('manager.progress', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
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
        //
    }

    public function remove(Request $request)
    {
        $studentHistory = StudentHistory::where('subject_id', $request->subject_id)
                                        ->where('student_id', $request->student_id)
                                        ->first();

        $studentHistory->delete();

        return $studentHistory ? back()->with('success', 'A conta do aluno foi removido com sucesso!')
                            : back()->with('fail', 'Ocorreu algum problema ao tentar remover a conta do aluno!');
    }

    public function search(Request $request)
    {
        // $students::DB
        // $filters = $request->except('_token');
        // $professors = Professor::all();
        // return view('manager.dashboard', compact('students', 'filters', 'professors'));
    }
}
