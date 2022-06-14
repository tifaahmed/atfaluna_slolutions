<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;

class IfActiveUserMiddleware
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
        $sub_user = Auth::user();
        if ($sub_user->active) {
            return $next($request);
        }
        else {
            return \Response::json( [
                'message'   => 'this acount not active.' ,
                'status'    => 'false.' ,
                'code'      => Response::HTTP_BAD_REQUEST           ,
            ] + [] , Response::HTTP_BAD_REQUEST);
        }    
    }
}
