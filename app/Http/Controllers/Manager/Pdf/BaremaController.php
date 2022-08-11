<?php

namespace App\Http\Controllers\Manager\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use PDF;

class BaremaController extends Controller
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
        $pdf = PDF::loadView('manager.pdfs_templates.barema', compact('tcc','members'));
        return $pdf->stream('declaracao.pdf');
    }
}
