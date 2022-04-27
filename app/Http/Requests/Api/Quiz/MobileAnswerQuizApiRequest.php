<?php

namespace App\Http\Requests\Api\Quiz;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobileAnswerQuizApiRequest extends FormRequest
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
            'quiz_id'               =>  [ 'required' ,'integer' ,'exists:quizzes,id'] ,
            'sub_user_id'           =>  [ 'required' ,'integer' ,'exists:sub_users,id',] ,
            'question_attempt_id'   =>  [ 'required' ,'integer' ,'exists:question_attempts,id',] ,
            'answer'                =>  [ 'required' ,'boolean'] ,
        ];
    }
}
