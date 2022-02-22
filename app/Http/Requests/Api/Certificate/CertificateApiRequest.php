<?php

namespace App\Http\Requests\Api\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class CertificateApiRequest extends FormRequest
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
            'relation_id'       =>  [ 'required' ,'integer'] ,
            'relation_type'     =>  [ 'required'] ,
            'image_one'         =>  [ 'required' ,'max:5000'] ,
            'image_two'         =>  [ 'required' ,'max:5000'] ,
            'min_point'         =>  [ 'required' ,'integer'] ,
            'max_point'         =>  [ 'required' ,'integer'] ,
            'subject_id'        =>  [ 'required' ,'integer'] ,
            'sub_users_id'      =>  [ 'required' ,'integer'] ,

        ];
    }
}
