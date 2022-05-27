<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\TccRequest;
use App\Models\Advisor;
use App\Models\Student;
use App\Models\StudentHistory;
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
    public function index()
    {
        return view('student.tcc.progress');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $advisors = Advisor::all();
        return view('student.tcc.tcc', compact('advisors'));
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
        $data['advisor_id'] = $request->advisor;
        $data['student_id'] = Auth::user()->id;
        $data['subject_id'] = StudentHistory::query(function($query){
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
