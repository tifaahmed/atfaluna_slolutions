<?php

namespace App\Http\Resources\Mobile\ControllerResources\AccessoryController;

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

        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;
        $all += [ 'image'     =>  ( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)) ]  ;
        $all += [ 'name'     =>  $row ? $row->name:'']  ;

        return   $all ;
    }
}
//