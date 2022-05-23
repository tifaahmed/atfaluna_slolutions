<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Response ;
use Illuminate\Http\JsonResponse ;

class IfSubscriptionMiddleware
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

            $sub_user_subscription = $sub_user->SubUserSubscriptions()->first();
            if ($sub_user_subscription && Carbon::now() >= $sub_user_subscription->start && Carbon::now() <= $sub_user_subscription->end) {
                return $next($request);
            }else {
                return \Response::json( [
                    'message'   => 'child subscription has ended' ,
                    'status'    => 'false.' ,
                    'code'      => Response::HTTP_UNAUTHORIZED           ,
                ] + [] , Response::HTTP_UNAUTHORIZED);
            
        }
        }else{
            return $next($request);
        }

    } 

}
