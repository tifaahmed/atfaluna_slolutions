<?php

namespace App\Http\Requests\Api\SubUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubUserApiRequest extends FormRequest
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
            'gender'=>[
                'required',
                    Rule::in(['boy', 'girl']),
            ],
            'name'       =>  [ 'required' ] ,
            
            'user_id'        =>  [ 'required' ,'integer','exists:users,id'] ,

            'age'        =>  [ 'required' ,'integer','exists:ages,age'] ,
            'points'     =>  [ 'integer' ] ,
            'avatar_ids' =>  [ 'sometimes','array','exists:avatars,id' ] ,
            'certificate_ids' =>  [ 'sometimes','array','exists:certificates,id' ] ,
            'subject_ids' =>  [ 'sometimes','array','exists:subjects,id' ] ,
            'sub_subject_ids' =>  [ 'sometimes','array','exists:sub_subjects,id' ] ,
            'lesson_ids' =>  [ 'sometimes','array','exists:lessons,id' ] ,
            'quiz_ids' =>  [ 'sometimes','array','exists:quizzes,id' ] ,
            'age_group_ids' =>  [ 'sometimes','array','exists:age_groups,id' ] ,
            'accessory_ids' =>  [ 'sometimes','array','exists:accessorys,id' ] ,
            'achievement_ids' =>  [ 'sometimes','array','exists:achievements,id' ] ,

        ];
    }
}
