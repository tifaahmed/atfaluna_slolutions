<?php

namespace App\Http\Requests\Api\SubUserLesson;

use Illuminate\Foundation\Http\FormRequest;

class SubUserLessonApiRequest extends FormRequest
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
            'sub_user_id'      =>  [ 'required' ,'integer'] ,
            'lesson_id'         =>  [ 'required' ,'integer'] ,
            'score'             =>  [ 'required' ,'integer'] ,
        ];
    }
}
