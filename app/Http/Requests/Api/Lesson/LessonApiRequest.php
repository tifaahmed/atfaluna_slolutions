<?php

namespace App\Http\Requests\Api\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class LessonApiRequest extends FormRequest
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
            'url'              =>  [ 'required' ,'max:5000'] ,
            'points'           =>  [ 'required' ,'integer']  ,
            'sub_subject_id'   =>  [ 'required' ,'integer','exists:sub_subjects,id']  ,
            'lesson_type_id'   =>  [ 'required' ,'integer','exists:lesson_types,id']  ,
        ];
    }
}
