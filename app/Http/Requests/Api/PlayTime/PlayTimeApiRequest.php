<?php

namespace App\Http\Requests\Api\PlayTime;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlayTimeApiRequest extends FormRequest
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
            'day'=>[
                'required',
                    Rule::in([1,2,3,4,5,6,7]),
                ],
            'status'                =>  [  'required' , 'boolean' ] ,
            'start'                 =>  [  'required' , 'integer' ] ,
            'end'                   =>  [  'required' , 'integer' ] ,
            'sub_user_id'           =>  [  'required' , 'integer' ] ,

        ];
    }
}
