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
            'image_one'     =>  ['sometimes','max:50000','mimes:jpg,jpeg,webp,bmp,png'] ,
            'image_two'     =>  ['sometimes' ,'max:50000','mimes:jpg,jpeg,webp,bmp,png'],
            'image_three'   =>  ['sometimes','max:50000','mimes:jpg,jpeg,webp,bmp,png']  ,
            'image_four'    =>  ['sometimes' ,'max:50000','mimes:jpg,jpeg,webp,bmp,png'] ,
            'title'         =>  ['required']  ,
            'subject'       =>  ['required']  ,
            'language'      =>  ['required'   , 'exists:languages,name']  ,

        ];
    }
}
