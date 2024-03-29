<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\loginApiRequest ;
use App\Http\Requests\Api\RegisterApiRequest ;
use App\Http\Requests\Api\Auth\ForgetPasswordByEmailApiRequest ;
use App\Http\Requests\Api\Auth\CheckPinCodeRequest ;

use App\Models\User ;

use Illuminate\Http\Response ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Resources\Mobile\ControllerResources\authController\UserResource;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use DB;
use Carbon\Carbon;
class authController extends Controller {
 
    public function __construct(){
        $this->path = 'user';
        $this->disk = 'public';
        $this->folder_name = 'store';
    }

    public function login( loginApiRequest $request ) {

        if(!auth('api')->check()){
            if ( $request -> get( 'email' , false ) ) {
                $user = User::where( 'email' , $request -> get( 'email' ) ) -> first( ) ;

            
            }
            if ( ! Hash::check( $request -> password , $user -> password ) ) {
                return $this -> MakeResponseErrors( 
                    [ 'message' => 'InvalidCredentials' ],  
                    'InvalidCredentials' ,
                    Response::HTTP_UNAUTHORIZED
                ) ; 
            }

            return $this ->loginRespons($request->fcm_token,$user->email,$user->id);

        }else{
            return $this -> MakeResponseErrors( 
                [ 'message' => 'loggin in before' ],  
                'InvalidCredentials' ,
                Response::HTTP_UNAUTHORIZED
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
            $all += array( 'active' => 1 );

            $user  = User::create($all);
            $user->assignRole('parent');

        }

        return $this ->loginRespons($request->fcm_token,$user->email,$user->id);

    }
    
    public function register( RegisterApiRequest $request ) {

        $user  = User::create([
            'password' => Hash::make($request->password),
            'name' => $request -> get( 'name' ),
            'email' => $request -> get( 'email' ),
            'phone' => $request -> get( 'phone' ),
            'country_id' => $request -> get( 'country_id' ),
            'birthdate' => $request -> get( 'birthdate' ),
            
            'remember_token' => Hash::make( Str::random(60) )  ,
            'token' => Hash::make( Str::random(60) )  ,
        ]);
        $user->assignRole('parent');

        
        return $this ->loginRespons($request->fcm_token,$user->email,$user->id);

    }


    public function logout( Request $request ) {
        Auth::user()->token()->revoke();
        return $this -> MakeResponseSuccessful( 
            ['user logout Successful'],
            'Successful' ,
            Response::HTTP_OK
         ) ;
    }


    public function forget_password(ForgetPasswordByEmailApiRequest $request)
    {

        $status = Password::sendResetLink(
            $request->only('email')
        );
        
        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }
        return $this -> MakeResponseSuccessful( 
            ['send email Successfully'],
            'Successful' ,
            Response::HTTP_OK
         ) ;
    }

    public function check_pin_code(CheckPinCodeRequest $request){
        if(!auth('api')->check()){
            $user =  User::where('pin_code',$request->pin_code)->first();
            if ($user) {
                 
                $user->update([ 'active' => 1 ]);
                \DB::table('oauth_access_tokens')
                ->Where('name',$user -> email)
                ->delete();

                return $this ->loginRespons($request->fcm_token,$user->email,$user->id);

            }else{
                return $this -> MakeResponseSuccessful( 
                    [ 'message' => 'InvalidCredentials' ],  
                    'InvalidCredentials' ,
                    Response::HTTP_UNAUTHORIZED
                ) ;  
            }
        }else{
            return $this -> MakeResponseErrors( 
                [ 'message' => 'loggin in before' ],  
                'InvalidCredentials' ,
                Response::HTTP_UNAUTHORIZED
            ) ; 
        } 
    }

    public function update_password(Request $request)
    {
        Auth::user()->update(['password'=>Hash::make($request->password)]);
        return $this -> MakeResponseSuccessful( 
            ['message'=> 'Password reset successfully'],
            'Successful' ,
            Response::HTTP_OK
        ) ;
    }

    public function loginRespons($fcm_token,$email,$user_id)
    {   

        Auth::loginUsingId($user_id);
        Auth::user()->active ? null : Auth::user()->sendActiveEmailNotification();

        $sub_users = Auth::user()->sub_user()->get();

        // if not first time &  child_number  more than  tokens (revoke tokens)
        if ( Auth::user()->tokens()->count() > $sub_users->count() ){
            // Auth::user()->tokens()->latest('created_at')->first()->revoke();
            Auth::user()->tokens()->first('created_at')->revoke();
        }    


        \DB::table('oauth_access_tokens')
        ->Where('name',$email)
        ->Where('revoked', 1 )
        ->delete();

        \DB::table('oauth_access_tokens')
        ->Where('fcm_token',$fcm_token)
        ->delete();


        $token = Auth::user() -> getToken( ) ;
        $token->token->update([ 'fcm_token' => $fcm_token ]);
        return $this -> MakeResponseSuccessful( 
            [
                'user'  =>   new UserResource ( User::find(Auth::user()->id)   )   , 
                'Token' =>  Auth::user() -> perviewToken($token) 
            ],  
            'Successful' ,
            Response::HTTP_OK
        ) ;
    }

    public function premanently_delete() {
        $user_id = Auth::user()->id;
        Auth::user()->sub_user()->forceDelete();
        Auth::user()->token()->revoke();

        User::find($user_id)->forceDelete();

        return $this -> MakeResponseSuccessful( 
            ['message'=> 'user deleted'],
            'Successful',
            Response::HTTP_OK
        ) ;
    }


}
