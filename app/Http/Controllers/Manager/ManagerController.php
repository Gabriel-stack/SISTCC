<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\RegisterRequest;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function assignCharge(Request $request)
    {
        // Fazer regra de atribuição de cargo de professor da disciplina.
        $professor = false;

        return $professor ? redirect()->back()->with('sucess', 'Foi atribuido o cargo de professor da disciplina!')
            : redirect()->back()->with('fail', 'Ocorreu um erro ao tentar atribuir o cargo de professor da disciplina!');
    }

    public function removeCharge(Request $request)
    {
        // Fazer regra de remoção de cargo de professor da disciplina.
        $professor = false;

        return $professor ? redirect()->back()->with('sucess', 'Foi removido a atribuição de cargo de professor da disciplina!')
            : redirect()->back()->with('fail', 'Ocorreu um erro ao tentar remover a atribuição de cargo de professor da disciplina!');
    }
}
