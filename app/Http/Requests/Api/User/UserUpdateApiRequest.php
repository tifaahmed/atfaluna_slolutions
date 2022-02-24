<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateApiRequest extends FormRequest
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
                'name'      =>  [  'required','unique:users,name,'.$this->id ,'max:50'] ,
                'email'     =>  [  'required','unique:users,email,'.$this->id  ,'email'] ,
                'phone'     =>  [  'required','unique:users,phone,'.$this->id  ,'max:15' ] ,

                'password'  =>  [  'sometimes','min:6' , 'max:15' ],
                'password_confirmation'  =>  [ 'exclude_unless:password,true', 'min:6' , 'max:15' ],

                'avatar'    =>  [ 'sometimes','required' ,  'max:5000'] 
        ];
    }
}
