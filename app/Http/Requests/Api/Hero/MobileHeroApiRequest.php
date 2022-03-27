<?php

namespace App\Http\Requests\Api\Hero;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobileHeroApiRequest extends FormRequest
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
            'hero_ids'         =>  [ 'required' ,'array' ,'exists:heroes,id'] ,
            'sub_user_id'       =>  [ 'required' ,'integer' ,'exists:sub_users,id',] ,
        ]; 
    }
}
