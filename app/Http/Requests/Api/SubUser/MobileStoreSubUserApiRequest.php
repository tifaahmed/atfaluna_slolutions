<?php

namespace App\Http\Requests\Api\SubUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobileStoreSubUserApiRequest extends FormRequest
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
        'gender'=>[
            'required',
                Rule::in(['boy', 'girl']),
            ],
            'name'       =>  [ 'required' ] ,
            'age'        =>  [ 'required' ,'integer'] ,
            'points'     =>  [ 'required','integer' ] ,
            'avatar_id'  =>  [ 'required','integer','exists:avatars,id' ] ,

        ];
    }
}
