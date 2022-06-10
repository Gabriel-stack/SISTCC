<?php

namespace App\Http\Controllers\Professor\Report;

use App\Http\Controllers\Controller;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use PDF;

class AtaController extends Controller
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
        $pdf = PDF::loadView('manager.pdfs_templates.ata', compact('tcc','members'));
        return $pdf->stream('ata.pdf');
    }
}
