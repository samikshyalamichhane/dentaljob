<?php

namespace Modules\Jobseeker\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!auth()->user()) {
            $job_url = url()->previous();
            session()->put('__jobURL', $job_url);
            return redirect()->route('jobseeker.login')->with(['message' => 'Please login !', 'type' => 'danger']);
        }

        if (auth()->user() && auth()->user()->role != 'jobseeker') {
            return redirect()->route('jobseeker.login')->with(['message' => 'Please login as jobseeker !', 'type' => 'danger']);
        }

        // $uInfo = Session::get('frontSession');

        return $next($request);
    }
}
