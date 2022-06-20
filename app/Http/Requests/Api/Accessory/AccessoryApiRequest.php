<?php

namespace App\Http\Requests\Api\Accessory;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;

class AccessoryApiRequest extends FormRequest
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
        $all += [ 'image'           =>  [ 'required' ,'max:50000'] ]  ;
        $all += [ 'price'           =>  [ 'required' ,'numeric','between:0,9999.99'] ]  ;
        $all += [ 'type'           =>  [ 'required' ] ]  ;
        $all += ['gender'=>[
            'required',
                Rule::in(['girl','boy','both']),
            ]] ;

            foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'   =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.description'   =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }

}

