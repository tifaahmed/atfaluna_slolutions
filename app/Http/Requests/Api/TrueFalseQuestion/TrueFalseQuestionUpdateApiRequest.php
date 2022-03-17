<?php

namespace App\Http\Requests\Api\TrueFalseQuestion;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class TrueFalseQuestionUpdateApiRequest extends FormRequest
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
        $all += [ 'image'           =>  [ 'sometimes' ,'max:5000'] ]  ;
        $all += [ 'videos'          =>  [ 'sometimes' ,'max:5000'] ]  ;
        $all += [ 'audio'           =>  [ 'sometimes' ,'max:5000'] ]  ;
        $all += [ 'answer'          =>  [ 'required' ,'boolean' ] ]  ;
        $all += [ 'quiz_id'         =>  [ 'required' ,'integer','exists:quizzes,id'] ]  ;

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.title'   =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }

}
