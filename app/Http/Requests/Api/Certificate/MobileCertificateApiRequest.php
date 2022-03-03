<?php

namespace App\Http\Requests\Api\Certificate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobileCertificateApiRequest extends FormRequest
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
        return [
            'certificate_id'    =>  [ 'required' ,'integer' ,'exists:certificates,id'] ,
            'sub_user_id'       =>  [ 'required' ,'integer' ,'exists:sub_users,id',] ,
        ];
    }
}
