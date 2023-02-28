<?php

namespace App\Http\Requests\Api\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;
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

        // sub_subjects
        $all += [ 'sub_subject_id'   =>  [ 'required' ,'integer','exists:sub_subjects,id'] ]  ;

        // lesson_types
        $all += [ 'lesson_type_id'   =>  [ 'required' ,'integer','exists:lesson_types,id'] ] ;

        // quiz
        $all += [ 'quiz_ids'  =>  [ 'sometimes' ,'array','exists:quizzes,id'] ]  ;

        // skill
        $all += [ 'skill_ids'  =>  [ 'sometimes' ,'array','exists:skills,id'] ]  ;

        // lessons
        $all += [ 'points'           =>  [ 'integer'] ]  ;

        // lesson_languages
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'        =>  [ 'required'  , 'max:255'] ] ;
            $all += [ 'languages.'.$key.'.url'         =>  [ 'sometimes'  , 'max:100000','mimes:zip,mp4'] ] ;
            $all += [ 'languages.'.$key.'.image_one'   =>  [ 'sometimes'  , 'max:50000' ,'mimes:jpg,jpeg,webp,bmp,png' ] ] ;
            $all += [ 'languages.'.$key.'.image_two'   =>  [ 'sometimes'  , 'max:50000' ,'mimes:jpg,jpeg,webp,bmp,png' ] ] ;      
            
            // language
            $all += [ 'languages.'.$key.'.language'     =>  [ 'required' , 'max:2' ,'exists:languages,name' ,Rule::in([$value->name]) ] ] ;
        }
        
        // notification 
        $all += [ 'notificate'           =>  [ 'sometimes','boolean' ] ]  ;
        foreach ($Languages as $key => $value) {
            $all += [ 'notification.'.$key.'.title'          =>  [ 'required_if:notificate,1' , 'max:255' ] ]  ;
            $all += [ 'notification.'.$key.'.subject'        =>  [ 'required_if:notificate,1' , 'max:255' ] ]  ;
            $all += [ 'notification.'.$key.'.lang'           =>  [ 'required_if:notificate,1' , 'max:2' , 'exists:languages,name' ] ]  ;
        }

        return $all;
    }
}
