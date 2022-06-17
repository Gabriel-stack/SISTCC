<?php

namespace App\Http\Middleware;

use App\Models\Tcc;
use Closure;
use Illuminate\Http\Request;

class PreventSubjectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        abort_if(Tcc::where('subject_id', $request->subject)
            ->where('student_id', Auth()->user()->id)
            ->first() === null ,403, 'Você não tem permissão para acessar esta disciplina.');

        return $next($request);
    }
}
