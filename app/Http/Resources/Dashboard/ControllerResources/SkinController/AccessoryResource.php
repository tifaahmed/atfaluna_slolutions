<?php

namespace App\Http\Resources\Dashboard\ControllerResources\SkinController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\ControllerResources\SkinController\ActivityResource;
use App\Http\Resources\Dashboard\ControllerResources\SkinController\LessonResource;

class AccessoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->accessory_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,

            'name'          => $row ? $row->name:'',
            
            'image'        => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,

            'price'         => $this->price,

            'gender'        =>  $this->gender,

            
        ];   
    }
}
