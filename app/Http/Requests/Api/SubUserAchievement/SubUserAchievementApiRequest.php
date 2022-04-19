<?php

namespace App\Http\Requests\Api\SubUserAchievement;

use Illuminate\Foundation\Http\FormRequest;

class SubUserAchievementApiRequest extends FormRequest
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
            'achievement_ids'       =>  [ 'required' ,'array' ,'exists:achievements,id'] ,
            'sub_user_id'           =>  [ 'required' ,'integer' ,'exists:sub_users,id',] ,
        ];
    }

}

