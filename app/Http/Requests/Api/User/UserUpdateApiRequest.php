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
                'name'      =>  [  'required','max:50'] ,
                'email'     =>  [  'required','unique:users,email,'.$this->id  ,'email'] ,
                'phone'     =>  [  'required' ,'unique:users,phone,'.$this->id  ,'max:15' ] ,

                'password'  =>  [  'required','min:8' , 'max:15' ],
                'password_confirmation'  =>  [ 'required','exclude_unless:password,true', 'min:8' , 'max:15' ],

                'avatar'    =>  [ 'sometimes',  'max:5000'] ,

                'birthdate '=>  [  'date' , 'date_format:Y/d/m'] ,
                'city_id'=>  [  'sometimes' , 'integer','exists:cities,id' ] ,
        ];
    }
}
