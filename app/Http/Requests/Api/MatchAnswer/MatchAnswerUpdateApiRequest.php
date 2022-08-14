<?php

namespace App\Http\Requests\Api\MatchAnswer;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
class MatchAnswerUpdateApiRequest extends FormRequest
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
                 // match_answer_id
        $all += [ 'image'           =>  [ 'sometimes' ,'max:50000'] ]  ;
        $all += [ 'match_question_id'         =>  [ 'required' ,'integer','exists:match_questions,id'] ] ;
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.title'   =>  [ 'sometimes' ] ] ;
            $all += [ 'languages.'.$key.'.audio'   =>  [ 'sometimes' ,'max:5000'] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
