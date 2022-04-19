<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;
use Carbon\Carbon;
class IfPlayTimeMiddleware
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
            $playTimes = $sub_user->playTime()->where('day',Carbon::now()->dayOfWeek)->get();
            $flag = 0;
            foreach ($playTimes as $key => $value) {
                if (Carbon::now()->between($value->start, $value->end)) {
                    $flag = 1 ;
                }
            }
            if ($flag) {
                return $next($request);
            }else {
                return Response()->json( 
                    [
                        'message' => 'now is not play time.' ,
                        'check' => 'false.' ,
                        'code'   => Response::HTTP_UNAUTHORIZED           ,
                    ],
                );
            }    
        }else{
            return $next($request);
        }
    }

}
