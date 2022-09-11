<?php

namespace App\Http\Requests\Api\Conversation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConversationApiRequest extends FormRequest
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
        $all=[];
        $all += [ 'type'           =>  [ 'required' ,Rule::in(['single', 'group']),] ]  ;
        $all += [ 'sub_user_id'           =>  [ 'required' ,'integer' , 'exists:sub_users,id'] ]  ;

        if ($this->type == 'single') {
            $all += [ 'recevier_ids'       =>  [ 'required' ,'array','exists:sub_users,id','not_in:'.$this->sub_user_id,'max:1']]  ;
        }else if ($this->type == 'group') {
            foreach ($this->recevier_ids as $key => $value) {
                $all += [ 'recevier_ids.'.$key         =>  [ 'required' ,'integer','exists:sub_users,id','not_in:'.$this->sub_user_id]]  ;
            }
        }
            // 'type'=>[
            //     'nullable',
            //         Rule::in(['single', 'group']),
            //     ],
        return  $all;
    }
} 