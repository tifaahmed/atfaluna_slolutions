<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;
class IfAuthChildMiddleware
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
			if(Auth::user()->sub_user()->find($request->sub_user_id)){
                return $next($request);

            }else{
                return Response()->json( 
                    [
                        'message' => 'not child for the authenticated parent.' ,
                        'check' => 'false.' ,
                        'code'   => Response::HTTP_UNAUTHORIZED           ,
                    ],
                );
            }
    }
}
