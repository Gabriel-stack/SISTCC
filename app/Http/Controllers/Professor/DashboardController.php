<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate();

        return view('professor.dashboard', compact('students'));
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

        return view('professor.progress', compact('student'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $student->delete();

        if ($student) {
            return redirect()->back()->with('success', 'O aluno foi excluído com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar excluir o aluno!');
    }

    public function disable(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $student->update(['active' => false]);

        if ($student) {
            return redirect()->back()->with('success', 'A conta do aluno foi desativado com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar desativar a conta do aluno!');
    }

    public function active(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $student->update(['active' => true]);

        if ($student) {
            return redirect()->back()->with('success', 'A conta do aluno foi ativada com sucesso!');
        }

        return redirect()->back()->with('fail', 'Ocorreu algum problema ao tentar ativar a conta do aluno!');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $students = Student::where('name', 'LIKE', '%' . $request->search . '%')->paginate();
        }

        $filters = $request->except('_token');

        return view('professor.dashboard', compact('students', 'filters'));
    }
}
