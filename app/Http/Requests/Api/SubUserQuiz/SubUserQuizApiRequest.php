<?php

namespace App\Http\Requests\Api\SubUserQuiz;

use Illuminate\Foundation\Http\FormRequest;

class SubUserQuizApiRequest extends FormRequest
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
            'sub_users_id'      =>  [ 'required' ,'integer'] ,
            'quiz_id'         =>  [ 'required' ,'integer'] ,
            'score'             =>  [ 'required' ,'integer'] ,
        ];
    }
}
