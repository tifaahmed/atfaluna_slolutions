<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;
class IfDashboardAllawedMiddleware
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
        if (Auth::user()->hasRole(['admin'])  ) {
            return $next($request);
        }else{
            return       
            Response()->json( 
                [
                    'message' => 'Un Authenticated.' ,
                    'check' => 'false.' ,
                    'code'   => Response::HTTP_UNAUTHORIZED           ,
                ],
            );
        }


    }
}
