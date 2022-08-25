<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterApiRequest extends FormRequest {
 public function authorize()
    {
        return true;
    }
    public function rules( ) {
        return [
            'name'      =>  [ 'required','max:50'] ,
            'email'     =>  [ 'required' , 'unique:users,email' ,'email'] ,
            'phone'     =>  [ 'required' , 'unique:users,phone' ,'max:15' ] ,

            'password'  =>  [ 'required' , 'confirmed' ,  'min:8' , 'max:15' ],
            'password_confirmation'  =>  [ 'required' , 'min:8' , 'max:15' ],

            'avatar'    =>  [ 'sometimes', 'mimes:jpg,jpeg,png' , 'max:5000'] ,
            'fcm_token' => [ 'sometimes'] ,

            'birthdate '=>  [  'date' , 'date_format:Y/d/m'] ,
            'country_id'=>  [  'required' , 'integer','exists:countries,id' ] ,
        ];
    }
}
