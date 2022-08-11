<?php

namespace App\Http\Controllers\Manager\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Nette\Utils\Json;
use PDF;

class DeclaracaoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tcc = Tcc::findOrFail($request->tcc);
        abort_if($tcc->stage != 'Etapa 3', 403, 'Ação não permitida para esse tcc');
        $members = Json::decode($tcc->members);
        $banca = collect([$tcc->professor]);
        foreach ($members as $value) {
            $banca->push($value);
        }
        $pdf = PDF::loadView('manager.pdfs_templates.declaracao', compact('tcc','members', 'banca'));
        return $pdf->stream('barema.pdf');
    }
}
