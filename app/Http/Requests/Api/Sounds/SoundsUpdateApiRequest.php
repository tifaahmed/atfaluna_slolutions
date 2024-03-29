<?php

namespace App\Http\Requests\Api\Sounds;

use Illuminate\Foundation\Http\FormRequest;
class SoundsUpdateApiRequest extends FormRequest
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
            'name'          =>  ['required']  ,
            'record'        =>  ['sometimes','max:100000', 'mimes:mp3,wav']  ,
            'language'      =>  ['required' ,'max:2','exists:languages,name']  ,
        ];
    }
}
