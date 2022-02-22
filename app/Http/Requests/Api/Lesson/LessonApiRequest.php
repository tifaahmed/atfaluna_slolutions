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
            'image'            =>  [ 'required' ,'max:5000'] ,
            'url'              =>  [ 'required' ,'max:5000'] ,
            'points'           =>  [ 'required' ,'integer']  ,
            'subject_id'       =>  [ 'required' ,'integer']  ,
            'lesson_type_id'   =>  [ 'required' ,'integer']  ,

        ];
    }
}
