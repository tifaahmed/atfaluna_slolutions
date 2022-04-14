<?php

namespace App\Http\Requests\Api\MassageImage;

use Illuminate\Foundation\Http\FormRequest;
class MassageImageUpdateApiRequest extends FormRequest
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
            'image'   =>  [ 'required','max:50000' ] ,

        ];
    }
}
