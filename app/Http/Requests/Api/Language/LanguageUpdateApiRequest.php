<?php


namespace App\Http\Requests\Api\Language;

use Illuminate\Foundation\Http\FormRequest;

class LanguageUpdateApiRequest extends FormRequest
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
        'name'       =>  [ 'required' , 'max:2'     , 'unique:languages,name,'.$this->id      ] ,
        'full_name'  =>  [ 'required' , 'max:20'    , 'unique:languages,full_name,'.$this->id ] ,
        ];
    }
}

