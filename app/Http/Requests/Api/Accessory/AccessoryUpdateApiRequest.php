<?php

namespace App\Http\Requests\Api\Accessory;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;

class AccessoryUpdateApiRequest extends FormRequest
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

        // accessories
        $all += [ 'image'           =>  [ 'required' ,'max:50000'] ]  ;
        $all += [ 'price'           =>  [ 'required' ,'numeric','between:0,9999.99'] ]  ;
        $all += [ 'gender'          =>  [ 'required', Rule::in(['girl','boy','both']), ]] ;

        // body_suits (one)
        $all += [ 'body_suit_id'    =>  [ 'required' ,'integer' ,'exists:body_suits,id'] ]  ;

        // activities (m)
        $all += [ 'activity_ids'    =>  [ 'required' ,'array' ,'exists:activities,id'] ]  ;

        // lessons (m)
        $all += [ 'lesson_ids'    =>  [ 'required' ,'array' ,'exists:lessons,id'] ]  ;

        // skins (m)
        $all += [ 'skin_ids'    =>  [ 'required' ,'array' , 'exists:skins,id' ] ] ;

        // $all += [ 'skin_ids'    =>  [ 'required' ,'array' , Rule::exists('skins', 'id')->where('original', 0) ] ] ;
        // accessory_languages
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'   =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.description'   =>  [ 'required' ] ] ;
            
            // language
            $all += [ 'languages.'.$key.'.language'     =>  [ 'required' , 'max:2' ,'exists:languages,name'  ] ] ;
        }
        
        return $all;
    }

}