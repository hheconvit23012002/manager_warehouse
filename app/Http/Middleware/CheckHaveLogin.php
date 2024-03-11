<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHaveLogin
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
        $userLogin = \session()->get('user');
        if(is_null($userLogin)){
            return redirect()->route('login')->with('error','you must login');
        }
        return $next($request);
    }
}
