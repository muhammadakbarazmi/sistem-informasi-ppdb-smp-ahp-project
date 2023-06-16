<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels){
        if(in_array(auth()->user()->level,$levels) == 'admin'){
            return $next($request);
        }else if(in_array(auth()->user()->levels,$levels) == 'guru'){
            return $next($request);
        }else if(in_array(auth()->user()->levels,$levels) == 'siswa'){
            return $next($request);
        }
        else{
            return redirect('/login');
        }
    }
}
