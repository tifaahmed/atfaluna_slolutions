<?php

namespace App\Http\Requests\Api\RolePermissionRequest;

use Illuminate\Foundation\Http\FormRequest;

class ModelHasPermissionApiRequest extends FormRequest
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
                'permission_ids'     =>  [ 'required' , 'array'  , 'exists:permissions,id' ] ,
                'model_id'           =>  [ 'required' , 'integer' , 'exists:users,id'] ,
                // 'model_type'        =>  [ 'required' ] ,
            ];


    }
}
