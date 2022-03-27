<?php

namespace App\Http\Requests\Api\HeroLesson;

use Illuminate\Foundation\Http\FormRequest;

class HeroLessonApiRequest extends FormRequest
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
            'heros_id'      =>  [ 'required' ,'integer'] ,
            'lesson_id'         =>  [ 'required' ,'integer'] ,
        ];
    }
}
