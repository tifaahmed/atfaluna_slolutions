<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CheckPinCodeRequest extends FormRequest {
    public function authorize()
       {
           return true;
       }
    public function rules( ) {
        return [
            'pin_code'    => [ 'required' , 'integer'] ,
            'fcm_token'   => [ 'required'] ,
        ];
    }
}
