<?php

namespace App\Http\Requests\Api\SubSubject;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SubSubjectUpdateApiRequest extends FormRequest
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
        $all += [ 'subject_id'   =>  [ 'required' ,'integer','exists:subjects,id'] ] ;
        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'        =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.description' =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.image_two'   =>  [ 'sometimes' ,'max:50000'] ] ;
            $all += [ 'languages.'.$key.'.image_one'   =>  [ 'sometimes' ,'max:50000'] ] ;
            $all += [ 'languages.'.$key.'.language'    =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
