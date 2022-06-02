<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\TccRequest;
use App\Models\Professor;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subject)
    {
        $is_active_class = Subject::where('id', $subject)->first()->is_active;
        $professors = Professor::all();
        return view('student.tcc.tcc', compact('professors', 'is_active_class'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TccRequest $request)
    {
        $data = $request->all();
        $data['professor_id'] = $request->professor;
        $data['student_id'] = Auth::user()->id;
        $data['subject_id'] = Tcc::query(function($query){
            $query->where('student_id', Auth::user()->id)->pluck('subject_id');
        })->first();
        dd($data);
        $tcc = Tcc::create($data);

        if (!$tcc) {
            return redirect()->back()->with('fail', 'Erro ao cadastrar TCC');
        }
        return redirect()->back()->with('success', 'TCC cadastrado com sucesso!');
    }



    public function requirement(){
        return view('student.tcc.requirement');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
