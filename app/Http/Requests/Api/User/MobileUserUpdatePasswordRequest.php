<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MyPassword;
class MobileUserUpdatePasswordRequest extends FormRequest
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
            'old_password'  =>  [  'required','min:6' , 'max:15' , new MyPassword ],
            'password'  =>  [  'required','min:8' , 'confirmed' , 'max:15' , 'different:old_password'],
            'password_confirmation'  =>  [ 'required', 'min:8' , 'max:15' ],
        ];
    }

}
