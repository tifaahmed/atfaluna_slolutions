<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name'      =>  [ 'required' , 'unique:users,name' ,'max:50'] ,
                'email'     =>  [ 'required' , 'unique:users,email' ,'email'] ,
                'phone'     =>  [ 'required' , 'unique:users,phone' ,'max:15' ] ,

                'password'  =>  [ 'required' , 'confirmed' ,  'min:6' , 'max:15' ],
                'password_confirmation'  =>  [ 'required' , 'min:6' , 'max:15' ],

                'avatar'    =>  [ 'sometimes', 'mimes:jpg,jpeg,png' , 'max:5000'] ,
                'country_id'    =>  [ 'required' , 'integer'] 
        ];
    }
}
