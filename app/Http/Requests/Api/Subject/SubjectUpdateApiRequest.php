<?php

namespace App\Http\Requests\Api\Subject;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;

class SubjectUpdateApiRequest extends FormRequest
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

        // quiz
        $all += [ 'quiz_id'  =>  [ 'required' ,'integer','exists:quizzes,id'] ]  ;

        // certificate
        $all += [ 'certificate_id'  =>  [ 'required' ,'integer',Rule::exists('certificates', 'id')->where('certificatable_id',null)] ]  ;

        // skill
        $all += [ 'skill_ids'  =>  [ 'sometimes' ,'array','exists:skills,id'] ]  ;

        // age_group
        $all += [ 'age_group_id'    =>  [ 'required' ,'integer','exists:age_groups,id'] ] ;

        // subject      
        $all += [ 'image'           =>  [ 'required' ,'max:5000','mimes:jpg,jpeg,webp,bmp,png' ] ] ;
        $all += [ 'points'          =>  [ 'sometimes' ,'integer' ] ]  ;

        // subject_languages
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'         =>  [ 'required' , 'max:255'  ] ] ;
            
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
