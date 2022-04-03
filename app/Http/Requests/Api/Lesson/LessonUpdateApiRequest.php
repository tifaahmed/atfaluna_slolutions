<?php

namespace App\Http\Requests\Api\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
class LessonUpdateApiRequest extends FormRequest
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
        $Languages=Language::get();

        $all=[];

        // lessons
        $all += [ 'points'           =>  [ 'integer'] ]  ;
        $all += [ 'sub_subject_id'   =>  [ 'required' ,'integer','exists:sub_subjects,id'] ]  ;
        $all += [ 'lesson_type_id'   =>  [ 'required' ,'integer','exists:lesson_types,id'] ] ;

        // quiz
        $all += [ 'quiz_ids'  =>  [ 'sometimes' ,'array','exists:quizzes,id'] ]  ;

        // lesson_languages
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'        =>  [ 'required'  , 'max:255'] ] ;
            $all += [ 'languages.'.$key.'.url'         =>  [ 'required'  , 'max:100000','mimes:zip'] ] ;
            $all += [ 'languages.'.$key.'.image_one'   =>  [ 'required'  , 'max:50000' ,'mimes:jpg,jpeg,webp,bmp,png' ] ] ;
            $all += [ 'languages.'.$key.'.image_two'   =>  [ 'required'  , 'max:50000' ,'mimes:jpg,jpeg,webp,bmp,png' ] ] ;      
            $all += [ 'languages.'.$key.'.language'    =>  [ 'required'  , 'max:2' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
