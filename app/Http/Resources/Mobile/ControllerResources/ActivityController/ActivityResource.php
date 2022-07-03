<?php

namespace App\Http\Resources\Mobile\ControllerResources\ActivityController;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\Storage;

use App\Models\Basic;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $row=$this->activity_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1);

        $sub_user_activity = isset($request->sub_user_id) ? $this->subUserActivity()->where('sub_user_id',$request->sub_user_id)->withPivot('points')->first() : null ;

        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;
        if (!$sub_user_activity ) {
            $all += [ 'image'     =>  ( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)) ]  ;
        }else{
            $all += [ 'image'     =>  ( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)) ]  ;
        }
        $all += [ 'url'     =>  ( $row && $row->url       && Storage::disk('public')->exists($row->url) )? asset(Storage::url($row->url))  : asset(Storage::url($basic->item)) ]  ;
        $all += [ 'name'     =>  $row ? $row->name:'']  ;
        $all += [ 'points'     => $this->points ]  ;
        $all += [ 'achive_points'     =>  ( $sub_user_activity  && $sub_user_activity->pivot ) ? $sub_user_activity->pivot->points : 0  ]  ;
        $all += [ 'seen'     => $sub_user_activity ? 1 : 0 ]  ;
        $all += [ 'activity_accessories' => $this->AccessoryActivity()->get()->pluck('id')->toArray() ]  ;
        return   $all ;

    }
}
//