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
        $all += [ 'points'       =>  [ 'integer'] ]  ; // default 0
        $all += [ 'minimum_requirements'       =>  [ 'integer'] ]  ; // default 0
        
        // $model_name = 'App\Models\Lesson';
        // if ($this->quizable_type == 'sub_subject') {
        //     $model_name = 'App\Models\Sub_subject';
        // }else if ($this->quizable_type == 'subject'){
        //     $model_name = 'App\Models\Subject';
        // }else if ($this->quizable_type == 'lesson'){
        //     $model_name = 'App\Models\Lesson';
        // }
        // $all += [ 'quizable_type'   =>  [ 'required' ,Rule::in(['subject', 'sub_subject' , 'lesson']) ] ] ;

        // $all += [ 'quizable_id'     =>  ['required','integer','exists:'.$model_name.',id' ,
        //     Rule::unique('quizzes')->where(function ($query) use($model_name) {
        //         if ($model_name != 'App\Models\Lesson' ) {
        //             return $query->where('quizable_type',$model_name);
        //         }else{
        //             return $query->where('id','0');
        //         }
        //     })->ignore($this->id),
        // ] ]  ;
        
        // quiz_questions
        $all += [ 'mcq_question_ids'  =>  [ 'sometimes' ,'array','exists:mcq_questions,id'] ]  ;
        $all += [ 'true_false_question_ids'  =>  [ 'sometimes' ,'array','exists:true_false_questions,id'] ]  ;

        
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
