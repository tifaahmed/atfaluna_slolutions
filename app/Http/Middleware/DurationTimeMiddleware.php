<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DurationTimeMiddleware
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
        $sub_user = Auth::user()->sub_user()->find($request->sub_user_id);
        if( $sub_user){
            $durationTime = $sub_user->durationTime()->whereDate('created_at', '=', date('Y-m-d'))->first();
            if ($durationTime) {

                $currentTime = Carbon::now();
                $diffInMinutes = $currentTime->diffInMinutes($durationTime->updated_at);

                $durationTime->update(['time_count' => $durationTime->time_count + ( ($diffInMinutes >= 10) ? 10/60: $diffInMinutes/60 )]);

            }else{
                $sub_user->durationTime()->create();
            }
        }

        return $next($request);
    }
}
