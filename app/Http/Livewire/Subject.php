<?php

namespace App\Http\Livewire;

use App\Models\Professor;
use App\Models\Student;
use App\Models\StudentHistory;
use App\Models\Subject as ModelsSubject;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Subject extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'page' => ['except' => 1],
    ];
    public $subject;


    public $teste = 'teste';
    public $search_name;
    public $select_situation;
    public $select_stage;
    public $select_professor;
    

    
    public function mount(Request $request)
    {
        $this->subject = ModelsSubject::findOrFail($request->id);
        
    }

    public function render()
    {
        return view('livewire.subject',[
                    'students' => Student::paginate(10),
                    'professors' => Professor::all(), 
                    'subject' => $this->subject,

                ]);
    }


    public function searchByName()
    {
        $student = $this->students->when($this->search_name, function ($query) {
            return $query->where('name', 'like', "%{$this->search_name}%");
        });
        $this->students = $student;
    }

    public function show($student)
    {
        dd($student);
        // $student = Student::findOrFail($student);

        return view('manager.progress', compact('student'));
    }
}
