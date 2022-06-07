<?php

namespace App\Http\Requests\Api\Quiz;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;

class QuizUpdateApiRequest extends FormRequest
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
        // quizzes
        $all += [ 'points'                      =>  [ 'required' ,'integer'] ]  ; // default 0
        $all += [ 'minimum_requirements'        =>  [ 'required' ,'integer'] ]  ; // default 0
        
        // quiz_questions
        $all += [ 'mcq_question_ids'        =>  [ 'sometimes' ,'array','exists:mcq_questions,id'] ]  ;
        $all += [ 'true_false_question_ids' =>  [ 'sometimes' ,'array','exists:true_false_questions,id'] ]  ;

        // quiz_types
        $all += [ 'quiz_type_id'        =>  [ 'required' ,'integer','exists:quiz_types,id'] ]  ;

        // quiz_languages
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'         =>  [ 'required' , 'max:255'  ] ] ;
            $all += [ 'languages.'.$key.'.image_one'    =>  [ 'required' , 'max:50000'] ] ;
            $all += [ 'languages.'.$key.'.image_two'    =>  [ 'required' , 'max:50000'] ] ;
            $all += [ 'languages.'.$key.'.language'     =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
        }
        
        return $all;
    }
}
