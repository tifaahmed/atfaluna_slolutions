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

        $sub_user_quizzes = isset($request->sub_user_id) ? $this->sub_user_activity->where('sub_user_id',$request->sub_user_id) : null ;

        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;
        if ($sub_user_quizzes && $sub_user_quizzes->count() <= 0) {
            $all += [ 'image'     =>  ( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)) ]  ;
        }else{
            $all += [ 'image'     =>  ( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)) ]  ;
        }
        $all += [ 'url'     =>  ( $row && $row->url       && Storage::disk('public')->exists($row->url) )? asset(Storage::url($row->url))  : asset(Storage::url($basic->item)) ]  ;
        $all += [ 'name'     =>  $row ? $row->name:'']  ;
        $all += [ 'points'     => $this->points ]  ;
        $all += [ 'seen'     => ($sub_user_quizzes && $sub_user_quizzes->count()) > 0 ? 1 : 0 ]  ;

        return   $all ;

    }
}
//