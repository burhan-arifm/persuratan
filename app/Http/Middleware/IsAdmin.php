<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if (auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect()->back()->with('message', ['title' => 'Anda tidak memiliki hak untuk mengakses laman ini.', 'icon' => 'error']);
    }
}
