<?php

namespace App\Http\Requests\Api\Massage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Hero;
use App\Models\Avatar;
use App\Models\Massage_image;
use App\Rules\ConversationMember;

class MassageApiRequest extends FormRequest
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
        if ($this->massagable_type == 'hero') {
            $class = Hero::class;
        }else if($this->massagable_type == 'image'){
            $class = Massage_image::class;
        }else if($this->massagable_type == 'avatar'){
            $class = Avatar::class;
        }

        return [
            'massagable_type'       =>  [ Rule::in(['hero', 'image','avatar']) ] ,
            'text'                  =>  [ 'max:250' ] ,
            'massagable_id'         =>  [ 'integer' , 'exists:'.$class.',id' ] ,
            'sub_user_id'           =>  [ 'required' ,'integer' , 'exists:sub_users,id'] ,
            'conversation_id'       =>  [ 'required' ,'integer' , 'exists:conversations,id' , new ConversationMember($this->sub_user_id) ] ,
        ];
    }
}