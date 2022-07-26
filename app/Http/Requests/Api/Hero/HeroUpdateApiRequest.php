<?php

namespace App\Http\Requests\Api\Hero;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
class HeroUpdateApiRequest extends FormRequest
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
        
        $all += [ 'lesson_ids'         =>  [ 'sometimes' ,'array','exists:lessons,id'] ]  ;

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.title'   =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.description'   =>  [ 'required'] ] ;
            $all += [ 'languages.'.$key.'.image'   =>  [ 'required' ,'max:50000'] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
