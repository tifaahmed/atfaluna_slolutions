<?php

namespace App\Http\Requests\Api\RolePerssionRequest;

use Illuminate\Foundation\Http\FormRequest;

class PermissionApiRequest extends FormRequest
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
                'name'              =>  [ 'required','max:255' ,'unique:permissions,name' ] ,
                'description'       =>  [   'max:255'] ,
                // 'guard_name'        =>  [ 'required' , 'max:255'] ,
        ];
    }
}
