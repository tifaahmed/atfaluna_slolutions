<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;
 
class IfAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
 
    public function handle(Request $request, Closure $next, $permission = null)
    {
        if($permission != null) {
            if (! Auth::guard( 'api' )->user()->can($permission)  ) {
               return $next($request);
            }
        }
        return \Response::json( [
            'message'   => 'Un Authenticated.',
            'status'    => 'false.' ,
            'code'      => Response::HTTP_UNAUTHORIZED           ,
        ] + [] , Response::HTTP_UNAUTHORIZED);

  
    }
}
