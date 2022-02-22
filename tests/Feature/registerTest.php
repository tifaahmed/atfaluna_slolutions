<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response ;

class registerTest extends TestCase {
	use WithFaker ;
	public function testRegisterBaseApi( ) {
		// $faker = $this->faker  ;

		// if(name,email,phone,password) not exist
		// $this-> 
		// 	postJson( '/api/register' )
		// 	-> assertStatus( Response::HTTP_UNPROCESSABLE_ENTITY )
		// 	-> assertJson( [
		// 	    'message' => 'The given data was invalid.' ,
		// 	    'errors' => [
		// 	        'name'     => [ 'The name field is required.' ] ,
		// 	        'email'    => [ 'The email field is required.' ] ,
		// 	        'phone'    => [ 'The phone field is required.' ] ,
		// 	        'password' => [ 'The password field is required.']
		// 	    ]
		// 	] )
		// ;
		// if(name) not exist
		// $this
		//     -> postJson( '/api/register' , [ 
		//     	'email'  =>  $faker  -> unique( ) -> safeEmail        ( ),
		//     	'phone'  =>  $faker  -> unique( ) -> phoneNumber ( ),
		//     	'password' => $faker  -> password() 
		//     ])
		//     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY  )
		//     -> AssertJson( [
		//     	'message' => 'The given data was invalid.' ,
		//     	'errors' => [
		//     		'name'     => [ 'The name field is required.' ] ,
		//     	]
		//     ])
		// ;
		// if(email) not exist
		// $this
		//     -> postJson( '/api/register' , [ 
		//     	'name'     =>  $faker -> name ( ),
		//     	'phone'    =>  $faker -> unique( ) -> phoneNumber ( ),
		//     	'password' => $faker -> password() 
		//     ])
		//     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY  )
		//     -> AssertJson( [
		//     	'message' => 'The given data was invalid.' ,
		//     	'errors'  => [
		//     		'email'     => [ 'The email field is required.' ] ,
		//     	]
		//     ])
		// ;
		// if(password) not exist
 		// $this
		 //    -> postJson( '/api/register' , [ 
		 //    	'name'   =>  $faker  -> name        ( ),
		 //    	'email'  =>  $faker  -> unique( ) -> safeEmail        ( ),
		 //    	'phone'  =>  $faker  -> unique( ) -> phoneNumber ( ),
		 //    ])
 		//     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY )
 		//     -> AssertJson( [
 		//     	'message' => 'The given data was invalid.' ,
 		//     	'errors'  => [
 		//     	    'password' => [ 'The password field is required.' ]
 		//     	]
 		//     ])
 		// ;
 		// if(password) greater than 10 characters
 		// $this
 		//     -> postJson( '/api/register' , [ 
 		//     	'name'      =>  $faker  ->   name ( ),
 		//     	'email'     =>  $faker  ->  unique( ) -> safeEmail        ( ),
 		//     	'phone'     =>  $faker  ->  unique( ) -> phoneNumber ( ),
 		//     	'password'  =>  $faker  ->  password(11, 100) 
 		//     ])
 		//     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY  )
 		//     -> AssertJson( [
 		//     	'message' => 'The given data was invalid.' ,
 		//     	'errors'  => [
 		//     	    'password' => [ 'The password must not be greater than 10 characters.' ]
 		//     	]
 		//     ])
 		// ;
 		// if(email,phone) not unique  
		$user = User::Factory( ) -> create( )  ;
		// $this
		//     -> postJson( '/api/register' ,[
		//     	'name'     => $user  -> name  ,
		//         'email'    => $user  -> email ,
		//         'phone'    => $user  -> phone ,
		//         'password' => $faker  -> password(1, 10) 
		//     ])
		//     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY  )
		//     -> assertExactJson( [
		//     	'message' => 'The given data was invalid.' ,
		//     	'errors'  => [
		//     	    'phone' => [ 'The phone has already been taken.' ],
		//     	    'email' => [ 'The email has already been taken.' ]
		//     	]
		//     ])
		// ;
		// if(phone) not unique  
		// $this
		//     -> postJson( '/api/register' ,[
		//     	'name'     => $user  -> name  ,
		//         'email'    => $faker  ->  unique( ) -> safeEmail        ( ),
		//         'phone'    => $user  -> phone ,
		//         'password' => $faker  -> password(1, 10) 
		//     ])
		//     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY  )
		//     -> assertExactJson( [
		//     	'message' => 'The given data was invalid.' ,
		//     	'errors'  => [
		//     	    'phone' => [ 'The phone has already been taken.' ],
		//     	]
		//     ])
		// ;
		// if(email) not unique  
		// $this
		//     -> postJson( '/api/register' ,[
		//     	'name'     => $user  -> name  ,
		//         'email'    => $user  -> email ,
		//         'phone'    => $faker  ->  unique( ) -> phoneNumber ( ),
		//         'password' => $faker  -> password(1, 10) 
		//     ])
		//     -> AssertStatus( Response::HTTP_UNPROCESSABLE_ENTITY  )
		//     -> assertExactJson( [
		//     	'message' => 'The given data was invalid.' ,
		//     	'errors'  => [
		//     	    'email' => [ 'The email has already been taken.' ],
		//     	]
		//     ])
		// ;
		// post Successful
		// $this
		//     -> postJson( '/api/register' , [ 
		//     	'name'      =>  $faker  ->  name ( ),
		//     	'email'     =>  $faker  -> unique( ) -> safeEmail        ( ),
		//     	'phone'     =>  $faker  ->  unique( ) -> phoneNumber ( ),
		//     	'password'  =>  $faker  -> password(1, 10) 
		//     ])
		//     -> AssertStatus( Response::HTTP_OK )
		//     -> AssertJson( [
		//     	'message' => 'Successful' ,
		//     ])
		// ;
	}



}