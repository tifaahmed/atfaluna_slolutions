<?php

namespace App\Http\Requests\Api\Subject;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SubjectUpdateApiRequest extends FormRequest
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
        $all += [ 'quiz_id'  =>  [ 'required' ,'integer','exists:quizzes,id'] ]  ;

        // subjects        
        $all += [ 'image'           =>  [ 'sometimes' ,'max:5000'] ]  ;
        $all += [ 'points'          =>  [ 'required' ,'integer' ] ]  ;
        $all += [ 'age_group_id'  =>  [ 'required' ,'integer','exists:age_groups,id'] ] ;
        $all += [ 'sounds_id'  =>  [ 'sometimes' ,'integer','exists:sounds,id'] ]  ;

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'         =>  [ 'required' , 'max:255'  ] ] ;
            $all += [ 'languages.'.$key.'.language'     =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
