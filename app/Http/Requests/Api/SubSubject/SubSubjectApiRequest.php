<?php

namespace App\Http\Requests\Api\SubSubject;

use Illuminate\Foundation\Http\FormRequest;

class SubSubjectApiRequest extends FormRequest
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
            'subject_id'    =>  [ 'required','integer' ,'exists:subjects,id'] ,
        ];
    }
}
