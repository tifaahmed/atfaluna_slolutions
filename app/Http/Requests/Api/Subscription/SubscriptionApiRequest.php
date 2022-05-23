<?php

namespace App\Http\Requests\Api\Subscription;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SubscriptionApiRequest extends FormRequest
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
        $Languages=Language::get();

        $all=[];
        $all += [ 'month_number'           =>  [ 'required' ,'integer'] ]  ;
        $all += [ 'price'                  =>  [ 'required' ,'numeric','between:0,9999.99'] ]  ;

        foreach ($Languages as $key => $value) {
            $all += [ 'languages.'.$key.'.name'   =>  [ 'required' ] ] ;
            $all += [ 'languages.'.$key.'.language'   =>  [ 'required' ,'exists:languages,name'] ] ;
        }
        return $all;
    }
}
