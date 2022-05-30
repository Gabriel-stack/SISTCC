<?php

namespace App\Http\Livewire;

use App\Models\Professor;
use App\Models\Student;
use App\Models\Subject as ModelsSubject;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Subject extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // public ModelsSubject $subject;
    // public Professor $professors;
    // public Student $students;
    public $teste = 'teste';

    public $search;
    public $select_situation;
    public $select_stage;
    public $select_professor;


    // public function mount(Subject $subject)
    // {
    //     $this->subject = ModelsSubject::findOrFail($subject);
    //     $this->professors = Professor::all();
    //     $this->students = Student::paginate(10);
    //     dd($this->subject);
    // }

    public function render(Request $request)
    {
        // $this->students = StudentHistory();

        // $this->students = Student::where('name', '%' . $this->search . '%')
        //                         ->where('name', '%' . $this->select_situation . '%')
        //                         ->where('name', '%' . $this->select_stage . '%')
        //                         ->where('name', '%' . $this->select_professor . '%')
        //                         ->paginate(10);

        $subject = ModelsSubject::findOrFail($request->id);
        $professors = Professor::all();
        $students = Student::paginate(10);

        return view('livewire.subject', compact('students', 'professors', 'subject'));
    }

    public function show($student)
    {
        dd($student);
        // $student = Student::findOrFail($student);

        return view('manager.progress', compact('student'));
    }
}
