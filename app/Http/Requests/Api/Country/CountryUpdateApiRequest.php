<?php

namespace App\Http\Requests\Api\Country;

use Illuminate\Foundation\Http\FormRequest;

class CountryUpdateApiRequest extends FormRequest
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
            'name'       =>  [ 'required' ,'unique:countries,name,'.$this->id] ,
            'image'      =>  [ 'sometimes' ,'max:5000'] ,
            'language'   =>  [ 'required'] ,
            'code'       =>  [ 'required' ,'unique:countries,code,'.$this->id] ,
        ];
    }
}
