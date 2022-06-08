<?php

namespace App\Http\Controllers\Professor\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        dd($request->all());
        $pdf = PDF::loadView('manager.pdfs_templates.barema');
        return $pdf->stream('barema.pdf');
    }
        
}
