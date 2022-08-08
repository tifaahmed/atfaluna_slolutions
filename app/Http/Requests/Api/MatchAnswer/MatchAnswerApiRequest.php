<?php

namespace App\Http\Requests\Api\MatchAnswer;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;
use App\Rules\MatchAnswer;

class MatchAnswerApiRequest extends FormRequest
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

        $all += [ 'match_question_id'         =>  [ 'required' ,'integer','exists:match_questions,id' , new MatchAnswer($this->possition)]  ] ;
        

        $all += [ 'match_answer_id'         =>  [ 'required_if:possition,==,bottom',
            // Rule::exists('match_answers','id')->where(function ($query) {
            //     return $query->where('match_question_id', $this->match_question_id )->where('possition','top' );
            // }),                                                              
        ] ] ;



        
        $all += [ 'image'           =>  [ 'sometimes' ,'max:50000','mimes:jpg,jpeg,webp,bmp,png'] ]  ;
        $all += [ 'possition'          =>  [ 'required' ,  Rule::in(['top','bottom']),] ]  ;

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.title'   =>  [ 'sometimes' ] ] ;
            $all += [ 'languages.'.$key.'.audio'   =>  [ 'sometimes' ,'max:5000','mimes:m4a,M4A,MP3,FLAC,ABR,MPEG-4,mp4'] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }

        return $all;
        
    }
}
