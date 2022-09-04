<?php

namespace App\Http\Requests\Api\Skin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;

class SkinApiRequest extends FormRequest
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
        $all += [ 'image'            =>  [ 'required' ,'max:50000'] ]  ;
        $all += [ 'original'         =>  [ 'required'  , 'boolean'] ]  ;
        $all += [ 'avatar_id'        =>  [ 'required' ,'integer','exists:avatars,id'] ]  ;

            foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'   =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }

}

