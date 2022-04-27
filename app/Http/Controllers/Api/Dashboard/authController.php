<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\loginApiRequest ;
use App\Http\Requests\Api\User\RegisterApiRequest ;

use App\Models\User ;
use Illuminate\Http\Response ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Resources\Dashboard\UserResource;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
class authController extends Controller {
 

    public function login( loginApiRequest $request ) {
        if ( $request -> get( 'email' , false ) ) {
            $user = User::where( 'email' , $request -> get( 'email' ) ) -> first( ) ;
        }
        if ( ! Hash::check( $request -> password , $user -> password ) ) {
            return $this -> MakeResponseErrors( [ 'InvalidCredentials' ] , 'InvalidCredentials' , Response::HTTP_UNAUTHORIZED ) ;
        }

        if ( Auth()->attempt(['email' => $user->email, 'password' => $request->password],$request->_token) ){
            return $this -> MakeResponseSuccessful( 
                [
                    'user'  =>   new UserResource ( Auth::user()   )   , 
                    'Token' => Auth::user() -> getToken( ) 
                ],  
                'Successful' ,
                Response::HTTP_OK
            ) ; 
        }
    }

    public function register( RegisterApiRequest $request ) {

        $user  = User::create([
            'password' => Hash::make($request->password),
            'name' => $request -> get( 'name' ),
            'email' => $request -> get( 'email' ),
            'phone' => $request -> get( 'phone' ),

            'remember_token' => Hash::make( Str::random(60) )  ,
            'token' => Hash::make( Str::random(60) )  ,
            // 'remember_token' =>  'token' => Auth::user() -> getToken( ) 
        ]);
        if ( Auth::attempt(['email' => $user->email, 'password' => $request->password],$request->token) ){
            return $this -> MakeResponseSuccessful( 
                [
                    'user'  =>   new UserResource ( Auth::user()   )   , 
                    'Token' => Auth::user() -> getToken( ) 
                ],  
                'Successful' ,
                Response::HTTP_OK
            ) ; 
        }
    }


    public function logout( Request $request ) {
        // Auth::guard('sanctum')->logout();
        Auth::guard('api')->user()->token()->revoke();
        return $this -> MakeResponseSuccessful( 
            ['user'  => null ],
            'Successful' ,
            Response::HTTP_OK
         ) ;
    }

    public function forget_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }
    }

    public function reset_password(Request $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);
    }
}
