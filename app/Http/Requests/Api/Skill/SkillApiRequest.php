<?php

namespace App\Http\Requests\Api\Skill;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SkillApiRequest extends FormRequest
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
    
            foreach ($Languages as $key => $value) {

                $all += [ 'languages.'.$key.'.image'        =>  [ 'required' ,'max:50000','mimes:jpg,jpeg,webp,bmp,png'] ] ;
                $all += [ 'languages.'.$key.'.name'         =>  [ 'required' , 'unique:skill_languages,name' ] ] ;
                $all += [ 'languages.'.$key.'.language'     =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
            }
            return $all;

    }
}
