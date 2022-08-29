<?php

namespace App\Http\Requests\Api\Activity;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class ActivityUpdateApiRequest extends FormRequest
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

        $all += [ 'points'          =>  [ 'sometimes' ,'integer'] ]  ; //default:0
        $all += [ 'lesson_id'  =>  [ 'required' ,'integer','exists:lessons,id'] ]  ;

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'         =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.language'     =>  [ 'required' ,'exists:languages,name'] ] ;
            $all += [ 'languages.'.$key.'.url'         =>  [ 'required' , 'max:100000','mimes:zip' ] ] ;
            $all += [ 'languages.'.$key.'.image_one'   =>  [ 'required' , 'max:50000' ,'mimes:jpg,jpeg,webp,bmp,png' ] ] ;
            $all += [ 'languages.'.$key.'.image_two'   =>  [ 'required' , 'max:50000' ,'mimes:jpg,jpeg,webp,bmp,png' ] ] ;
        }
        return $all;
    }
}
