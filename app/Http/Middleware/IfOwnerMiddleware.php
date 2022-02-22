<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;

class IfOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $modelName = null)
    {
        if($modelName != null) {

            if($modelName == 'App\Models\User' ){
               $result = $modelName::where('id',Auth::guard( 'api' )->user()->id)->first();
            }else{
               $result = $modelName::where('user_id',Auth::guard( 'api' )->user()->id)->first();
            }
            

            if ( $result ) {
               return $next($request);
            }

        }
        return \Response::json( 
            ['message' => 'Un Authenticated.' ],
            false, 
            Response::HTTP_UNAUTHORIZED 
        );
    }
}
