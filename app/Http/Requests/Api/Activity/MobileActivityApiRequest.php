<?php

namespace App\Http\Requests\Api\Activity;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Activity;

class MobileActivityApiRequest extends FormRequest
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
        $activity = Activity::find($this->activity_id);
        $points = $activity ? $activity->points : 1;

        return [
            'activity_id'      =>  [ 'required' ,'integer' ,'exists:activities,id'] ,
            'sub_user_id'      =>  [ 'required' ,'integer' ,'exists:sub_users,id'] ,
            'points'           =>  [ 'required' ,'integer' ,'min:0' , 'max:'.$points ] ,
        ];
    }
}
