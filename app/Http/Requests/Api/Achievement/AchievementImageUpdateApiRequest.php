<?php

namespace App\Http\Requests\Api\Achievement;

use Illuminate\Foundation\Http\FormRequest;

class AchievementImageUpdateApiRequest extends FormRequest
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
            'image_one'        =>   [ 'required' ,'max:5000'] ,
            'image_two'        =>   [ 'required' ,'max:5000'] ,
            'points'           =>   [ 'sometimes' ,'integer'],
            'achievement_id'   =>   [ 'required' ,'integer','exists:achievements,id']  ,
        ];
    }
}
