<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PaginateApiRequest extends FormRequest {
    public function authorize()
       {
           return true;
       }
       
    public function rules( ) {
        return [
            'PerPage' =>   'required' , 'integer',
        ];
    }
}
