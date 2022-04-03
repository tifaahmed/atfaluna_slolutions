<?php

namespace App\Http\Requests\Api\About_us;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;
class AboutUsUpdateApiRequest extends FormRequest
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
            'image_one'     =>  ['required','max:50000'] ,
            'image_two'     =>  ['required' ,'max:50000' ],
            'image_three'   =>  [ 'required','max:50000']  ,
            'image_four'    =>  ['required' ,'max:50000'] ,
            'title'         =>  ['required', 'required']  ,
            'subject'       =>  ['required', 'required']  ,
            'language'      =>  ['required','exists:languages,name']  ,

        ];
    }
}
