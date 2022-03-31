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
        $all += [ 'points'           =>  [ 'required' ,'integer'] ]  ;
        $all += [ 'sub_subject_id'   =>  [ 'required' ,'integer','exists:sub_subjects,id'] ]  ;
        $all += [ 'lesson_type_id'   =>  [ 'required' ,'integer','exists:lesson_types,id'] ] ;
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'     =>  [ 'required'  ] ] ;
            $all += [ 'languages.'.$key.'.url'      =>  [ 'sometimes' ,'max:100000'] ] ;
            $all += [ 'languages.'.$key.'.image_one'   =>  [ 'required' ,'max:50000'] ] ;
            $all += [ 'languages.'.$key.'.image_two'   =>  [ 'required' ,'max:50000'] ] ;            
            $all += [ 'languages.'.$key.'.language' =>  [ 'required'  ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
