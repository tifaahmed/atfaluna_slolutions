<?php

namespace App\Http\Requests\Api\Certificate;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class CertificateUpdateApiRequest extends FormRequest
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
        $all += [ 'image_one'   =>  [ 'sometimes','max:50000' ] ] ;
        $all += [ 'image_two'   =>  [ 'sometimes' ,'max:50000'] ] ;
        $all += [ 'image_three' =>  [ 'sometimes' ,'max:50000'] ] ;
        $all += [ 'min_point'   =>  [ 'integer'  ,  'min:1'   ] ] ;
        $all += [ 'max_point'   =>  [ 'integer'  , 'gt:min_point' ] ];

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.title_one'    =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.title_two'    =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.subject'      =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.language'     =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
