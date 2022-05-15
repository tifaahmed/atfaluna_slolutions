<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class loginApiRequest extends FormRequest {
    public function authorize()
       {
           return true;
       }
    public function rules( ) {
        return [
            'email'    => [ 'required_without:phone' , 'email:rfc' , 'exists:users,email' ] ,
            'phone'    => [ 'required_without:email' , 'string'    , 'exists:users,phone' ] ,
            'password' => [ 'required'],
            'fcm_token'   => [ 'required'] ,

            // 'password' => [ 'required' , Password::min( 8 ) -> mixedCase( ) -> numbers( ) ]
        ];
    }
}
