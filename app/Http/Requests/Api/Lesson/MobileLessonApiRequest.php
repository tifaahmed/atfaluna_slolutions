<?php

namespace App\Http\Requests\Api\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class MobileLessonApiRequest extends FormRequest
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
            'lesson_id'         =>  [ 'required' ,'integer' ,'exists:lessons,id'] ,
            'sub_user_id'       =>  [ 'required' ,'integer' ,'exists:sub_users,id'] ,
            'percentage'        =>  [ 'required' ,'numeric' ] ,
        ]; 
    }
}
