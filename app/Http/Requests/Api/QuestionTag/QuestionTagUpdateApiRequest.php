<?php

namespace App\Http\Requests\Api\QuestionTag;

use Illuminate\Foundation\Http\FormRequest;

class QuestionTagUpdateApiRequest extends FormRequest
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
            'title'     =>  [ 'required' , 'unique:question_tags,title,'.$this->id  ] ,
        ];
    }
}
