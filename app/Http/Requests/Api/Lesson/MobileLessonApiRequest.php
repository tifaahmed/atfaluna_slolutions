<?php

namespace App\Http\Requests\Api\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Lesson;

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
        $lesson = Lesson::find($this->lesson_id);
        $points = $lesson ? $lesson->points : 1;

        return [
            'lesson_id'         =>  [ 'required' ,'integer' ,'exists:lessons,id'] ,
            'sub_user_id'       =>  [ 'required' ,'integer' ,'exists:sub_users,id'] ,
            'points'           =>  [ 'required' ,'integer' ,'min:0' , 'max:'.$points  ] ,
        ]; 
    }
}
