<?php

namespace App\Http\Requests\Api\Conversation;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
class ConversationUpdateApiRequest extends FormRequest
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
            'type'=>[
                'nullable',
                    Rule::in(['single', 'group']),
                ],
            'title'                 =>  [ 'nullable'] ,
            'read'                  =>  [ 'nullable','boolean'] ,
            'sub_user_id'           =>  [ 'required' ,'integer' , 'exists:sub_users,id'] ,
            'recevier_ids'           =>  [ 'required' ,'integer' ,'exists:sub_users,id',] ,


        ];
    }
}
