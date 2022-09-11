<?php

namespace App\Http\Resources\Dashboard\ControllerResources\AccessoryController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;



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

        return [
            'id'            => $this->id,    

            'name'          => $row ? $row->name:'',

            'image'        => $row && $row->image_two &&  Storage::disk('public')->exists($row->image_two)   ?   asset(Storage::url($row->image_two)) :null ,  

            'points'        => $this->points ,



        ];         
    }
}
//