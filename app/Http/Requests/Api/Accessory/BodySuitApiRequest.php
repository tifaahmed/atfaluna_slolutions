<?php

namespace App\Http\Requests\Api\Accessory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BodySuitApiRequest extends FormRequest
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
            'name'              =>  [ 'required' , 'unique:body_suits,name'] ,
            'human_part_ids'    =>  [ 'required' , 'array','exists:human_parts,id'] ,
            
        ];
    }
}
