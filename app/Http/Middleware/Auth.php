<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = auth()->user();
        // dd($user);

        if (is_null($user)) {
            if ($role == 'admin' || $role == 'super-admin' || !$role) {
                return redirect()->route('admin.login');
            }
            if ($role == 'employer') {
                return redirect()->route('jobseeker.login');
            }
            if ($role == 'jobseeker') {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
