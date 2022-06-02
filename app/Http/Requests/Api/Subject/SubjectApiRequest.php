<?php

namespace App\Http\Requests\Api\Subject;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SubjectApiRequest extends FormRequest
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

        // quiz
        $all += [ 'quiz_id'  =>  [ 'sometimes' ,'integer','exists:quizzes,id'] ]  ;
    
        // certificate
        $all += [ 'certificate_id'  =>  [ 'sometimes' ,'integer','exists:certificates,id'] ]  ;
    
        // subjects        
        $all += [ 'image'           =>  [ 'required' ,'max:5000','mimes:jpg,jpeg,webp,bmp,png' ] ] ;
        $all += [ 'points'          =>  [ 'integer' ] ]  ; //default:0
        $all += [ 'age_group_id'    =>  [ 'required' ,'integer','exists:age_groups,id'] ] ;
        $all += [ 'sounds_id'  =>  [ 'integer','exists:sounds,id'] ]  ;
        $all += [ 'skills_id'  =>  [ 'integer','exists:skills,id'] ]  ;

        // subject_languages
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'         =>  [ 'required' , 'max:255'  ] ] ;
            $all += [ 'languages.'.$key.'.language'     =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
