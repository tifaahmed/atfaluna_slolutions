<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\loginApiRequest ;
use App\Http\Requests\Api\RegisterApiRequest ;
use App\Models\User ;

use Illuminate\Http\Response ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Resources\Mobile\UserResource;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use DB;
class authController extends Controller {
 
    public function __construct(){
        $this->path = 'user';
        $this->disk = 'public';
        $this->folder_name = 'store';
    }

    public function login( loginApiRequest $request ) {
        if ( $request -> get( 'email' , false ) ) {
            $user = User::where( 'email' , $request -> get( 'email' ) ) -> first( ) ;
        }
        if ( ! Hash::check( $request -> password , $user -> password ) ) {

            if( $user->login_type ){
                return $this -> MakeResponseErrors( 
                    ['message' => $user->login_type ],  
                    'google' ,
                    Response::HTTP_UNAUTHORIZED
                ) ;
            }else{
                return $this -> MakeResponseErrors( 
                    [ 'message' => 'InvalidCredentials' ],  
                    'InvalidCredentials' ,
                    Response::HTTP_UNAUTHORIZED
                ) ; 
            }

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
    public function loginSocial( Request $request ) {

            $user = User::
            where( 'email'          , $request -> get( 'email' ) ) 
            // ->where( 'token'        , $request -> get( 'token' ) ) 
            // ->where( 'login_type'   , $request -> get( 'login_type' ) ) 
            -> first( ) ;

        if ( !$user ) {
            $all = [ ];

            $file_one = 'avatar';
            if ($request->hasFile($file_one)) {            
                $all += $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
            }
            $all += array( 'password'       => Hash::make('social') );
            $all += array( 'remember_token' => $request -> get( 'token' ) );
            $all += array( 'token'          => $request -> get( 'token' ) );

            $all += array( 'name'       => $request -> get( 'name' ) );
            $all += array( 'email'      => $request -> get( 'email' ) );
            $all += array( 'phone'      => $request -> get( 'phone' ) );
            $all += array( 'login_type' => $request -> get( 'login_type' ) );
            
            $user  = User::create($all);
        }

        Auth::loginUsingId($user->id);
            return $this -> MakeResponseSuccessful( 
                [
                    'user'  =>   new UserResource ( Auth::user()   )   , 
                    'Token' => Auth::user() -> getToken( ) 
                ],  
                'Successful' ,
                Response::HTTP_OK
            ) ; 
        
            
        
    }
    
    public function register( RegisterApiRequest $request ) {

        $user  = User::create([
            'password' => Hash::make($request->password),
            'name' => $request -> get( 'name' ),
            'email' => $request -> get( 'email' ),
            'phone' => $request -> get( 'phone' ),
            'country_id' => $request -> get( 'country_id' ),
            
            'remember_token' => Hash::make( Str::random(60) )  ,
            'token' => Hash::make( Str::random(60) )  ,
            // 'remember_token' =>  'token' => Auth::user() -> getToken( ) 
        ]);
        // $user->save();
        
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


    public function logout( Request $request ) {
        return Auth::user()->token()->revoke();
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
    public function check_pin_code(Request $request){
        $user =  User::where('pin_code',$request->pin_code)->first();
        if ($user) {
            Auth::login($user);

            return $this -> MakeResponseSuccessful( 
                [
                    'user'  =>   new UserResource ( Auth::user()   )   , 
                    'Token' => Auth::user() -> getToken( ) 
                ], 
                'Successful' ,
                Response::HTTP_OK
            ) ;
        }else{
            return $this -> MakeResponseSuccessful( 
                [ 'message' => 'InvalidCredentials' ],  
                'InvalidCredentials' ,
                Response::HTTP_UNAUTHORIZED
            ) ;  
        }
    }

    public function update_password(Request $request)
    {
        Auth::user()->update(['password'=>$request->password]);
        return $this -> MakeResponseSuccessful( 
            ['message'=> 'Password reset successfully'],
            'Successful' ,
            Response::HTTP_OK
        ) ;
    }
}
