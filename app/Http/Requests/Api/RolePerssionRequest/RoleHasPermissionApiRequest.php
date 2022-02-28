<?php

namespace App\Http\Requests\Api\RolePermissionRequest;

use Illuminate\Foundation\Http\FormRequest;

class RoleHasPermissionApiRequest extends FormRequest
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
            'permission_ids'     =>  [ 'required' , 'array' , 'exists:permissions,id' ] ,
            'role_id'           =>  [ 'required' , 'integer' , 'exists:roles,id' ] ,
        ];
    }
}
