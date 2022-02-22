<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;
class IfSuperAdminMiddleware
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
            // if (! Auth::guard( 'sanctum' )->user()->hasRole(['super-admin'])  ) {
            //    return $next($request);
            // }else{
            //     return \Response::json( 
            //         ['message' => 'Un Authenticated.' ],
            //         false, 
            //         Response::HTTP_UNAUTHORIZED 
            //     );
            // }
            return dd($request);

        
        
    }
}
