<?php

namespace App\Http\Requests\Api\Subject;

use Illuminate\Foundation\Http\FormRequest;

class SubjectApiRequest extends FormRequest
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
            'name'          =>  [ 'required'] ,
            'image'         =>  [ 'required' ,'max:5000'] ,
            'points'        =>  [ 'required' ,'integer'] ,
            'age_group_id'  =>  [ 'required' ,'integer'] ,

        ];
    }
}
