<?php

namespace App\Http\Requests\Api\User;

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
                'name'      =>  [ 'required' ,'max:50'] ,
                'email'     =>  [ 'required' , 'unique:users,email' ,'email'] ,
                'phone'     =>  [ 'required' ,  'integer' ,'unique:users,phone' ,'max:15' ] ,

                'password'  =>  [ 'required' , 'confirmed' ,  'min:8' , 'max:15' ],
                'password_confirmation'  =>  [ 'required' , 'min:8' , 'max:15' ],

                'avatar'    =>  [ 'sometimes', 'mimes:jpg,jpeg,png' , 'max:5000'] ,

                'birthdate '=>  [  'date' ] ,
                'country_id'=>  [  'required' , 'integer','exists:countries,id' ] ,
        ];
    }
}
