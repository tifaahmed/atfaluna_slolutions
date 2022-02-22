<?php

namespace App\Http\Requests\Api\Language;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateApiRequest  extends FormRequest {
    public function authorize()
       {
           return true;
       }
       
    public function rules( ) {
        return [
            'name'       =>  [ 'required' , 'max:2'     , 'unique:languages,name'      ] ,
            'full_name'  =>  [ 'required' , 'max:20'    , 'unique:languages,full_name' ] ,
        ];
    }
}


