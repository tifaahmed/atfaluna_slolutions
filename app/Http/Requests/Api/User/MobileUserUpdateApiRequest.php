<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class MobileUserUpdateApiRequest extends FormRequest
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
                'phone'     =>  [  'required', 'integer' , 'unique:users,phone,'.$this->id  ,'max:15' ] ,
                
                'birthdate '=>  [  'date' ] ,
                'country_id'=>  [  'required' , 'integer','exists:countries,id' ] ,
        ];
    }
}
