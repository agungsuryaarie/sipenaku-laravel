<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
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

        if (Auth::check() && Auth::user()->level == 1 || Auth::user()->level == 2) {
            return $next($request);
        }
        // Cara 1
        // if (!Auth::check()) {
        //     return redirect('login');
        // }
        // $user = Auth::user();
        // if ($user->level == 1 || $user->level == 2) {
        //     return $next($request);
        // }
        // Cara 2
        // if (Auth::check() && Auth::user()->level == $rules) {
        //     return $next($request);
        // }
        // Cara 3
        // if (in_array($request->user()->level, $levels)) {
        //     return $next($request);
        // }
        return redirect('login')->with('Maaf, kamu tidak memiliki hak akses!');
    }
}
