<?php

namespace App\Http\Requests\Api\GroupChat;

use Illuminate\Foundation\Http\FormRequest;
class GroupChatUpdateApiRequest extends FormRequest
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
            'recevier_id'               =>  [ 'required' ,'integer' , 'exists:sub_users,id'] ,
            'conversation_id'           =>  [ 'required' ,'integer' , 'exists:conversation,id'] ,
        ];
    }
}
