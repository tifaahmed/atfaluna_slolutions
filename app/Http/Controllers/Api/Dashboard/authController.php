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

use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class authController extends Controller {
 

    public function login( loginApiRequest $request ) {
        if ( isset($request->fcm_token) && $request->fcm_token ) {
            \DB::table('oauth_access_tokens')
            ->Where('fcm_token',$fcm_token)
            ->delete();
        }

        if (auth('api')->check()) {
            return $this -> MakeResponseErrors( 
                [ 'message' => 'loggin in before' ],  
                'InvalidCredentials' ,
                Response::HTTP_UNAUTHORIZED
            ) ; 
        }

        $user = User::where( 'email' , $request -> get( 'email' ) ) -> first( ) ;

        
        if($user &&  Hash::check( $request->password,$user->password )){
            if ( Auth()->attempt(['email' => $user->email, 'password' => $request->password],$request->_token) ){

                if ( Auth::user()->tokens()->count() >= 3 ){
                    DB::table('oauth_access_tokens')
                    ->Where('name',$email)
                    ->orderBy('created_at')
                    ->delete();
                }   

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

        return $this -> MakeResponseErrors( [ 'InvalidCredentials' ] , 'InvalidCredentials' , Response::HTTP_UNAUTHORIZED ) ;
        



    }




    public function logout( Request $request ) {
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($tokenId);
        Auth::user()->token()->revoke();
        return $this -> MakeResponseSuccessful( 
            ['user logout Successful'],
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
