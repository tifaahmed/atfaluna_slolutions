<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionApiRequest extends FormRequest
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
            'month_number'      =>  [ 'required','integer'] ,
            'child_number'      =>  [ 'required','integer'] ,
            'price'             =>  [ 'required','numeric','between:0,9999.99'] ,
        ];
    }
}
