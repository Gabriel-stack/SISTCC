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
    protected $queryString = [
        'page' => ['except' => 1],
    ];
    public $subject;
    public $professor;

    public $search_name;
    public $select_situation;
    public $select_stage;
    public $select_professor;


    public function mount(Request $request)
    {
        $this->subject = ModelsSubject::findOrFail($request->subject);
        $this->professor = Professor::all();
    }

    public function render()
    {
        $tccs = Tcc::with('student','professor')->where('subject_id', $this->subject->id)
        ->when($this->search_name, function ($query) {
            return $query->whereHas('student', function ($query) {
                return $query->where('name', 'like', '%' . $this->search_name . '%');
            });
        })->when($this->select_situation, function ($query) {
            return $query->where('situation', 'like', '%' . $this->select_situation . '%');
        })->when($this->select_stage, function ($query) {
            return $query->where('stage', 'like', '%' . $this->select_stage . '%');
        })->when($this->select_professor, function ($query) {
            return $query->where('professor_id', 'like', $this->select_professor);
        })->paginate(10);

        return view('livewire.subject', [
            'tccs' => $tccs,
            'professors' => $this->professor,
            'subject' => $this->subject,
        ]);
    }


    public $tcc_id;

    public function tccId($tcc_id)
    {
        $this->tcc_id = $tcc_id;
    }

    public function remove()
    {
        $tcc = Tcc::findOrFail($this->tcc_id);

        $tcc->delete();

        return $tcc ? back()->with('success', 'O aluno foi removido da turma com sucesso!')
            : back()->with('fail', 'Ocorreu algum problema ao tentar remover o aluno da turma!');
    }
}
