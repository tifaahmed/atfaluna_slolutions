<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ForgetPasswordByEmailApiRequest extends FormRequest {
    public function authorize()
       {
           return true;
       }
    public function rules( ) {
        return [
            'email'    => [ 'required' , 'email:rfc' , 'exists:users,email' ] ,
        ];
    }
}
