<?php

namespace App\Http\Requests\Api\McqAnswer;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
class McqAnswerUpdateApiRequest extends FormRequest
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
        $all += [ 'image'           =>  [ 'sometimes' ,'max:50000'] ]  ;
        $all += [ 'answer'          =>  [ 'required'] ]  ;
        $all += [ 'mcq_question_id'         =>  [ 'required' ,'integer','exists:mcq_questions,id'] ] ;
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.title'   =>  [ 'sometimes' ] ] ;
            $all += [ 'languages.'.$key.'.audio'   =>  [ 'sometimes' ,'max:5000'] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
