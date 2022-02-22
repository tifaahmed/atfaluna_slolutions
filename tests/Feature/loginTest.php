<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response ;

class loginTest extends TestCase {
    use WithFaker ;
    public function testLoginBaseApi( ) {
        // $this
        //     -> postJson( route( '/api.auth.login' ) )
        //     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY )
        //     -> assertExactJson( [
        //         'message' => 'The given data was invalid.' ,
        //         'errors' => [
        //             'email'    => [ 'The email field is required when phone is not present.' ] ,
        //             'phone'    => [ 'The phone field is required when email is not present.' ] ,
        //             'password' => [ 'The password field is required.'                        ]
        //         ]
        //     ] )
        // ;
        // $this
        //     -> postJson( route( '/api.auth.login' ) , [ 'phone' => $this -> faker( ) -> unique( ) -> phoneNumber ( ) ])
        //     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY )
        //     -> assertExactJson( [
        //         'message' => 'The given data was invalid.' ,
        //         'errors' => [
        //             'phone'    => [ 'The selected phone is invalid.'  ] ,
        //             'password' => [ 'The password field is required.' ]
        //         ]
        //     ])
        // ;
        // $this
        //     -> postJson( route( '/api.auth.login' ) , [ 'email' => $this -> faker( ) -> unique( ) -> safeEmail ( ) ])
        //     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY )
        //     -> assertExactJson( [
        //         'message' => 'The given data was invalid.' ,
        //         'errors' => [
        //             'email'    => [ 'The selected email is invalid.'  ] ,
        //             'password' => [ 'The password field is required.' ]
        //         ]
        //     ])
        // ;
    //     $this
    //         -> postJson( route( '/api.auth.login' ) , [ 'email' => ( $user = User::Factory( ) -> create( ) ) -> email ])
    //         -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY )
    //         -> assertExactJson( [
    //             'message' => 'The given data was invalid.' ,
    //             'errors' => [
    //                 'password' => [ 'The password field is required.' ]
    //             ]
    //         ])
    //     ;
    //     $this
    //         -> postJson( route( '/api.auth.login' ) ,[
    //             'email' => $user -> email ,
    //             'password' => 'passwoascrd1A'
    //         ])
    //         -> AssertStatus( Response::HTTP_UNAUTHORIZED )
    //         -> assertExactJson( [
    //             'message' => 'InvalidCredentials' ,
    //             'errors'  => [ 'InvalidCredentials' ]
    //         ])
    //     ;
    //     $response = $this
    //         -> postJson( route( '/api.auth.login' ) ,[
    //             'email'    => $user -> email ,
    //             'password' => 'password1A'
    //         ])
    //         -> AssertStatus( Response::HTTP_OK )
    //         -> AssertJson( [
    //             'message' => 'Successful' ,
    //             'check'   => true         ,
    //             'data' => [ 'user' => [
    //                 'id'    => $user -> id    ,
    //                 'name'  => $user -> name  ,
    //                 'email' => $user -> email ,
    //                 'phone' => $user -> phone ,
    //             ] ]
    //         ])
    //         -> assertJsonStructure( [ 'data' => [ 'Token' => [
    //             'token_type'    ,
    //             'expires_in'    ,
    //             'refresh_token' ,
    //             'access_token'  ,
    //         ] ] ] )
    //     ;
    //     $this
    //         -> withHeaders([ 'Authorization' => $response -> json( 'data.Token.token_type' ) . ' ' . $response -> json( 'data.Token.access_token' ) ])
    //         -> getJson( route( 'api.auth.me' ) )
    //         -> AssertStatus( Response::HTTP_OK )
    //         -> AssertJson( [
    //             'id'    => $user -> id    ,
    //             'name'  => $user -> name  ,
    //             'email' => $user -> email ,
    //             'phone' => $user -> phone ,
    //         ])
    //     ;
    }
}
