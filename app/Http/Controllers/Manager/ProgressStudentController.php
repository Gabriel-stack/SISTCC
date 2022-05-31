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
    public function show($subject,$tcc)
    {

        return view('manager.progress', [
            'tcc' => Tcc::with('student', 'professor')->where('subject_id', $subject)->findOrFail($tcc),
        ]);
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

    // public function remove(Request $request)
    // {
    //     $tcc = Tcc::where('subject_id', $request->subject_id)
    //         ->where('student_id', $request->student_id)
    //         ->first();

    //     $tcc->delete();

    //     return $tcc ? back()->with('success', 'O aluno foi removido da turma com sucesso!')
    //         : back()->with('fail', 'Ocorreu algum problema ao tentar remover o aluno da turma!');
    // }
}
