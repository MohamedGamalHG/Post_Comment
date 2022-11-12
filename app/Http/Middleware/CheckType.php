<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckType
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->status == 0)
            return redirect()->route('user.index');
        return $next($request);

    }
}
