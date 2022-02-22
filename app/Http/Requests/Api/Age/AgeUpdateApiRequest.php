<?php

namespace App\Http\Requests\Api\Age;

use Illuminate\Foundation\Http\FormRequest;

class AgeUpdateApiRequest extends FormRequest
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
            'age'                =>  [  'required' ,'integer','unique:ages,age,'.$this->id ] ,
            'age_group_id'       =>  [ 'required' ,'integer' ,'unsigned'] ,
        ];
    }
}
