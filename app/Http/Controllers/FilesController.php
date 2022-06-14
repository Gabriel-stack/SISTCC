<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        if(Storage::exists('tcc/'. $request->file)){
            return response()->file(storage_path('app/tcc/'.$request->file));
        }
        return response()->file(storage_path('app/historic/'.$request->file));
    }
}
