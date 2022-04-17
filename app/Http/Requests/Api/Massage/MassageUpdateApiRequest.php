<?php

namespace App\Http\Requests\Api\Massage;

use Illuminate\Foundation\Http\FormRequest;
class MassageUpdateApiRequest extends FormRequest
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
            'text'                  =>  [  'required' ] ,
            'massagable_id'         =>  [ 'required' ,'integer' , 'exists:'.$this->massagable_type.',id'] ,
            'massagable_type'       =>  [ 'required'] ,
            'sub_user_id'           =>  [ 'required' ,'integer' , 'exists:sub_users,id'] ,
            'conversation_id'       =>  [ 'required' ,'integer' , 'exists:conversation,id'] ,
        ];
    }
}