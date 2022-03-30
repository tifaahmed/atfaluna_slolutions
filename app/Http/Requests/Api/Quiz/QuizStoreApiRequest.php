<?php

namespace App\Http\Requests\Api\Quiz;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;

class QuizStoreApiRequest extends FormRequest
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
        $all += [ 'points'                      =>  [ 'integer'] ]  ; // default 0
        $all += [ 'minimum_requirements'        =>  [ 'integer'] ]  ; // default 0
        
        $model_name = 'App\Models\Lesson';
        if ($this->quizable_type == 'sub_subject') {
            $model_name = 'App\Models\Sub_subject';
        }else if ($this->quizable_type == 'subject'){
            $model_name = 'App\Models\Subject';
        }else if ($this->quizable_type == 'lesson'){
            $model_name = 'App\Models\Lesson';
        }
        $all += [ 'quizable_type'   =>  [ 'required' ,Rule::in(['subject', 'sub_subject' , 'lesson']) ] ] ;

        $all += [ 'quizable_id'     =>  ['required','integer','exists:'.$model_name.',id' ,
            Rule::unique('quizzes')->where(function ($query) use($model_name) {
                if ($model_name != 'App\Models\Lesson' ) {
                    return $query->where('quizable_type',$model_name);
                }else{
                    return $query->where('id','0');
                }
            })
        ] ]  ;
        
        // question_tagables
        foreach ($this->questionable_type as $question_key => $question_value) {
            $all += [ 'questionable_id.'.$question_key     =>  [ 'required' , 'exists:'.$this->questionable_type[$question_key].',id'] ]  ;
            $all += [ 'questionable_type.'.$question_key   =>  [ 'required' ] ] ;
        }
        // quiz_languages
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'     =>  [ 'required' , 'max:255' ] ] ;
            $all += [ 'languages.'.$key.'.image'    =>  [ 'required' , 'max:50000'] ] ;
            $all += [ 'languages.'.$key.'.language' =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
        }
        
        return $all;
    }
}
