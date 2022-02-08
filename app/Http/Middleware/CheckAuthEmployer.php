<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuthEmployer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authEmployer = auth()->user()->employer->id;

        $reqParams = $request->route()->parameters();

        if (isset($reqParams['employer'])) {
            $reqEmployer = $reqParams['employer'];
            if ($authEmployer != $reqEmployer) {
                return abort(403);
            }
        }

        return $next($request);
    }
}
