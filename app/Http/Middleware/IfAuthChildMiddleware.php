<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;
use Carbon\Carbon;
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
        if ($request->sub_user_id ) {
            $sub_user = Auth::user()->sub_user()->find($request->sub_user_id);
			if( $sub_user){
                return $next($request);
            }else{
                return \Response::json( [
                    'message'   => 'not child for the authenticated parent.' ,
                    'status'    => 'false.' ,
                    'code'      => Response::HTTP_BAD_REQUEST           ,
                ] + [] , Response::HTTP_BAD_REQUEST);
            }
        }else{
            return $next($request);
        }
        
    }
}
