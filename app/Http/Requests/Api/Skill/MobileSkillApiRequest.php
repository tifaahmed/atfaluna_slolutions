<?php

namespace App\Http\Requests\Api\Skill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobileSkillApiRequest extends FormRequest
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
            'skill_id'        =>  [ 'required' ,'integer' ,'exists:skills,id'] ,
            'subject_id'       =>  [ 'required' ,'integer' ,'exists:subjects,id',] ,
        ];
    }
}
