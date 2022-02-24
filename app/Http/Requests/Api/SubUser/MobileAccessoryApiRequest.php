<?php

namespace App\Http\Requests\Api\SubUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobileAccessoryApiRequest extends FormRequest
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
            'accessory_id'       =>  [ 'required' ,'integer' ,'exists:accessories,id'] ,
            'sub_user_id'        =>  [ 'required' ,'integer' ,'exists:sub_users,id'] ,
        ];
    }
}
