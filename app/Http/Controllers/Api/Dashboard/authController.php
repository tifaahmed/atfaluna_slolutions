<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\loginApiRequest ;
use App\Http\Requests\Api\RegisterApiRequest ;
use App\Models\User ;
use Illuminate\Http\Response ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Resources\Dashboard\UserResource;
use Illuminate\Support\Facades\Auth;
class authController extends Controller {
 

    public function login( loginApiRequest $request ) {
        if ( $request -> get( 'email' , false ) ) {
            $user = User::where( 'email' , $request -> get( 'email' ) ) -> first( ) ;
        }
        if ( ! Hash::check( $request -> password , $user -> password ) ) {
            return $this -> MakeResponseErrors( [ 'InvalidCredentials' ] , 'InvalidCredentials' , Response::HTTP_UNAUTHORIZED ) ;
        }

        if ( Auth::attempt(['email' => $user->email, 'password' => $request->password],$request->_token) ){
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
        // $user->save();
        

        return $this -> MakeResponseSuccessful( 
            ['user'  => $user ],
            'Successful'               ,
            Response::HTTP_OK
         ) ;
    }


    public function logout( Request $request ) {
       // Auth::guard( 'sanctum' ) -> logout( );
        // Auth::guard('sanctum')->logout();
        // Auth::logout();
        // $user->token()->revoke()
        Auth::guard( 'sanctum' )-> user()->currentAccessToken()->delete();
      
        // dd( Auth::user()  );
        return $this -> MakeResponseSuccessful( 
            ['user'  => null ],
            'Successful' ,
            Response::HTTP_OK
         ) ;
    }

}
