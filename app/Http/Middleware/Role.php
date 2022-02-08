<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
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

        $userRole = auth()->user()->role;

        if ($userRole == 'super-admin') {
            return $next($request);
        }

        // $segment contains the name after admin. E.g /admin/`segment`.
        // These segment are names in resourceful routes . E.g Route::resource('settings', 'SettingController')
        $segment =  $request->segment(2);

        if ($userRole != $role) {
            abort(403);
        }

        if ($userRole != 'admin') {
            return $next($request);
        }

        $access_levels_string = auth()->user()->access_level;
        $access_levels = explode(',', $access_levels_string);

        if (!in_array($segment, $access_levels)) {
            return redirect()->route('dashboard')->with('message', 'You dont have admin access');
        }

        return $next($request);
    }
}
