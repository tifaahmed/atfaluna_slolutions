<?php

namespace App\Http\Requests\Api\SubSubject;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SubSubjectApiRequest extends FormRequest
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
        $all += [ 'subject_id'   =>  [ 'required' ,'integer','exists:subjects,id'] ] ;

        // quiz
        $all += [ 'quiz_id'  =>  [ 'sometimes' ,'integer','exists:quizzes,id'] ]  ;

        $all += [ 'skill_id'   =>  [ 'sometimes' ,'integer','exists:skills,id'] ] ;

        $all += [ 'points'          =>  [ 'integer' ] ]  ; //default:0

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'        =>  [ 'required' , 'max:255' ] ] ;
            $all += [ 'languages.'.$key.'.description' =>  [ 'required' , 'max:255' ] ] ;
            $all += [ 'languages.'.$key.'.image_two'   =>  [ 'required' , 'max:50000' , 'mimes:jpg,jpeg,webp,bmp,png' ] ] ;
            $all += [ 'languages.'.$key.'.image_one'   =>  [ 'required' , 'max:50000' , 'mimes:jpg,jpeg,webp,bmp,png' ] ] ;
            $all += [ 'languages.'.$key.'.language'    =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
