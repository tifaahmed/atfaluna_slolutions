<?php

namespace App\Http\Requests\Api\Skillable;

use Illuminate\Foundation\Http\FormRequest;

class SkillableApiRequest extends FormRequest
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
            'skill_id'           =>  [ 'required'  ,'integer'  ,'exists:skills,id',] ,
        ];
    }

}