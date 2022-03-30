<?php

namespace App\Http\Requests\Api\TrueFalseQuestion;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;

class TrueFalseQuestionStoreApiRequest extends FormRequest
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
        
        // true_false_question
        $all += [ 'image'           =>  [ 'sometimes' ,'max:50000','mimes:jpg,jpeg,webp,bmp,png'] ]  ;
        $all += [ 'degree'          =>  [ 'integer' ] ]  ; //  default:0
        $all += [ 'level'           =>  [ Rule::in(['hard', 'medium', 'easy']), ] ]  ; //  default:easy
        $all += [ 'answer'          =>  [ 'boolean' ] ]  ; //  default:0

        // question_tags
        $all += [ 'question_tag_ids'  =>  [ 'sometimes' ,'array','exists:question_tags,id'] ]  ;

        // true_false_question_languages 
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.videos'   =>  [ 'sometimes' , 'max:5000','mimes:mp4'] ] ;
            $all += [ 'languages.'.$key.'.audio'    =>  [ 'sometimes' , 'max:5000','mimes:m4a,M4A,MP3,FLAC,ABR,MPEG-4,mp4'] ] ;
            
            $all += [ 'languages.'.$key.'.title'    =>  [ 'required' , 'max:255' ] ] ;
            $all += [ 'languages.'.$key.'.header'   =>  [ 'required' , 'max:255' ] ] ;
            
            $all += [ 'languages.'.$key.'.language' =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
        }
        return $all;
    }

}
