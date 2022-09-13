<?php

namespace App\Http\Requests\Api\McqQuestion;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
class McqQuestionUpdateApiRequest extends FormRequest
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
        $all += [ 'question_tag_ids'  =>  [ 'sometimes' ,'array','exists:question_tags,id'] ]  ;

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.video'   =>  [ 'sometimes' ,'max:5000','mimes:mp4'] ] ;

            $all += [ 'languages.'.$key.'.audio'   =>  [ 'sometimes' ,'max:5000','mimes:m4a,M4A,MP3,FLAC,ABR,MPEG-4,mp4'] ] ;
            $all += [ 'languages.'.$key.'.title'    =>  [ 'required' ] ] ;

            $all += [ 'languages.'.$key.'.header'    =>  [ 'required' ] ] ;
            
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
