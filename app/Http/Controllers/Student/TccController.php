<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Advisor;
use App\Models\Tcc;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $tcc = Tcc::create([
            'student_id' => auth()->user()->id,
            'advisor_id' => $request->advisor,
            'subject' => 1,
            'theme' => $request->theme,
            'title' => $request->title,
            'ethics_committee' => $request->ethics_committee,
            'term_commitment' => $request->file('term_commitment')
                ->store('tccs/' . auth()->user()->id),
            'date_claim' => $request->date_claim,
            'file_tcc' => $request->file('file_tcc')
                ->store('tccs/' . auth()->user()->id),
        ]);

        if (!$tcc) {
            return redirect()->back()->with('fail', 'Erro ao cadastrar TCC');
        }
        return redirect()->back()->with('success', 'TCC cadastrado com sucesso!');
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
