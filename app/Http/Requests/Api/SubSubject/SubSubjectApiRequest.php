<?php

namespace App\Http\Requests\Api\SubSubject;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SubSubjectApiRequest extends FormRequest
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

        // subject
        $all += [ 'subject_id'   =>  [ 'required' ,'integer','exists:subjects,id'] ] ;

        // quiz
        $all += [ 'quiz_id'  =>  [ 'sometimes' ,'integer','exists:quizzes,id'] ]  ;

        // skill
        $all += [ 'skill_ids'  =>  [ 'sometimes' ,'array','exists:skills,id'] ]  ;

        // sub subject
        $all += [ 'points'          =>  [ 'integer' ] ]  ; //default:0

        // sub subject $Language
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'        =>  [ 'required' , 'max:255' ] ] ;
            $all += [ 'languages.'.$key.'.description' =>  [ 'required' , 'max:255' ] ] ;
            $all += [ 'languages.'.$key.'.image_two'   =>  [ 'required' , 'max:50000' , 'mimes:jpg,jpeg,webp,bmp,png' ] ] ;
            $all += [ 'languages.'.$key.'.image_one'   =>  [ 'required' , 'max:50000' , 'mimes:jpg,jpeg,webp,bmp,png' ] ] ;
            
            // language
            $all += [ 'languages.'.$key.'.language'     =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
            
            // sound
            $all += [ 'languages.'.$key.'.sound_id'  =>  [ 'sometimes' ,'integer','exists:sounds,id'] ]  ;
        
        }

        // notification 
        $all += [ 'notificate'           =>  [ 'sometimes','boolean' ] ]  ;
        foreach ($Languages as $key => $value) {
            $all += [ 'notification.'.$key.'.title'          =>  [ 'required_if:notificate,1' , 'max:255' ] ]  ;
            $all += [ 'notification.'.$key.'.subject'        =>  [ 'required_if:notificate,1' , 'max:255' ] ]  ;
            $all += [ 'notification.'.$key.'.lang'           =>  [ 'required_if:notificate,1' , 'max:2' , 'exists:languages,name' ] ]  ;
        }
        
        return $all;
    }
}
