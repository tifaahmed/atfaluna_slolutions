<?php

namespace App\Http\Requests\Api\Package;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobilePackageApiRequest extends FormRequest
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
            
            'image'                   =>  [  'required' ,'max:5000' ] ,
            'price'                   =>  [  'required' , 'integer' ] ,
            'points'                  =>  [  'required' , 'integer' ] ,

        ];
    }
}
