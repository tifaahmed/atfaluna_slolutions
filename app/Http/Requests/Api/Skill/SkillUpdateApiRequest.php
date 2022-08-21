<?php

namespace App\Http\Requests\Api\Skill;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SkillUpdateApiRequest extends FormRequest
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

                $all += [ 'languages.'.$key.'.image_one'        =>  [ 'required' ,'max:50000','mimes:jpg,jpeg,webp,bmp,png'] ] ;
                $all += [ 'languages.'.$key.'.image_two'        =>  [ 'required' ,'max:50000','mimes:jpg,jpeg,webp,bmp,png'] ] ;
                $all += [ 'languages.'.$key.'.name'         =>  [ 'required' , 'unique:skill_languages,name,'.$this->id ] ] ;
                $all += [ 'languages.'.$key.'.description'   =>  [ 'required' ] ] ;
                $all += [ 'languages.'.$key.'.language'     =>  [ 'required' , 'max:2' ,'exists:languages,name'] ] ;
            }
            return $all;

    }
}
