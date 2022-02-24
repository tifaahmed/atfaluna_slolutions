<?php

namespace App\Http\Requests\Api\City;

use Illuminate\Foundation\Http\FormRequest;

class CityApiRequest extends FormRequest
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
            'name'                =>  [ 'required','unique:cities,name'] ,
            'government_id'       =>  [ 'required','integer'] ,
        ];
    }
}
