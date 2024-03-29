<?php

namespace App\Http\Requests\Api\AgeGroup;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class AgeGroupApiRequest extends FormRequest
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
        $all += [ 'age'           =>  [ 'required','integer'] ]  ;
        // certificate
        $all += [ 'certificate_id'  =>  [ 'required' ,'integer','exists:certificates,id'] ]  ;
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'       =>  [ 'required'] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }

}
