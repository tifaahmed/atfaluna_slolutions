<?php

namespace App\Http\Requests\Api\Friend;

use Illuminate\Foundation\Http\FormRequest;
class FriendApiRequest extends FormRequest
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
            'online' => [ 'required' , 'boolean' ],
            'accept' => [' required' , 'boolean' ],
            'block'  => ['required' , 'boolean'  ],
            'sub_user_id'           =>  [ 'required' ,'integer' , 'exists:sub_users,id'] ,
            'recevier_id'           =>  [ 'required' ,'integer' , 'exists:sub_users,id'] ,

        ];
    }
}  