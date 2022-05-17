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
        $user = Auth::user();
        $user_subscription = $user->userSubscription()->first();
        if ($user_subscription && $user_subscription->start <= Carbon::now() && $user_subscription->end >= Carbon::now()) {
            return $next($request);
        }else {
            return \Response::json( [
                'message'   => 'user_subscription has ended' ,
                'status'    => 'false.' ,
                'code'      => Response::HTTP_UNAUTHORIZED           ,
            ] + [] , Response::HTTP_UNAUTHORIZED);
        }
        

    } 

}
