<?php

namespace App\Http\Requests\Api\MatchQuestion;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class MatchQuestionApiRequest extends FormRequest
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

        $all += [ 'degree'          =>  [ 'required'] ]  ;

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.audio'   =>  [ 'sometimes' ,'max:5000','mimes:m4a,M4A,MP3,FLAC,ABR,MPEG-4,mp4'] ] ;

            $all += [ 'languages.'.$key.'.header'    =>  [ 'required' ] ] ;
            
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'max:2','exists:languages,name'] ] ;
        }
        return $all;
    }
}
