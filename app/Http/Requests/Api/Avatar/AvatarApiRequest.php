<?php

namespace App\Http\Requests\Api\Avatar;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AvatarApiRequest extends FormRequest
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
        'type'=>[
            'required',
                Rule::in(['boy', 'girl']),
            ],
            'image'       =>  [ 'required' ,'max:5000'] ,
            'price'      =>  [ 'numeric','between:0,9999.99'] ,
        ];
    }
}
