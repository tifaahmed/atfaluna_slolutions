<?php

namespace App\Http\Requests\Api\McqAnswer;

use Illuminate\Foundation\Http\FormRequest;

class McqAnswerApiRequest extends FormRequest
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
            'image'                    =>  [  'required' ,'max:5000' ] ,
            'answer'                   =>  [  'required' ] ,
            'mcq_questions_id'         =>  [  'required' ,'integer' ] ,

        ];
    }
}
