<?php

namespace App\Http\Controllers\Manager\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Professor;
use PDF;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $subject = $request->subject;
        $select_stage = $request->select_stage;
        $select_situation = $request->select_situation;
        $select_professor = $request->select_professor;
        $tccs = Json::decode($request->tccs);

        $professors = Professor::all();

        $pdf = PDF::loadView('manager.pdfs_templates.report', compact('tccs', 'subject', 'professors', 'select_stage', 'select_situation', 'select_professor'));
        return $pdf->stream('barema.pdf');
    }
}
