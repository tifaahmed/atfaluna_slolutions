<?php

namespace App\Http\Requests\Api\Subject;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobileSubjectApiRequest extends FormRequest
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
            'subject_id'        =>  [ 'required' ,'array' ,'exists:subjects,id'] ,
            'sub_user_id'       =>  [ 'required' ,'integer' ,'exists:sub_users,id',] ,
        ];
    }
}
