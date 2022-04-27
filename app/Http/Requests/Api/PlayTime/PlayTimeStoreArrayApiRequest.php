<?php

namespace App\Http\Requests\Api\PlayTime;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlayTimeStoreArrayApiRequest extends FormRequest
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
        $all=[];
        $all += [ 'sub_user_id'   =>  [ 'required'  ,'integer'  ,'exists:sub_users,id',] ] ;

        for ($i = 0; $i <= 6; $i++) {
            $all += [ 'day.'.$i     =>  [ 'required' ,Rule::in([1,2,3,4,5,6,0]), ] ] ;
            $all += [ 'status.'.$i  =>  [ 'required' , 'boolean' ] ] ;
            $all += [ 'start.'.$i   =>  [ 'required' , 'date_format:H:i:s' , 'after_or_equal:09:00:00'] ] ;
            $all += [ 'end.'.$i     =>  [ 'required' , 'date_format:H:i:s' , 'before_or_equal:18:00:00', 'after_or_equal:start.'.$i ] ] ;
        }
        return $all;

        

    }
}
