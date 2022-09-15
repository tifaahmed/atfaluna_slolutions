<?php

namespace App\Http\Resources\Dashboard\ControllerResources\ActivityController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    $row=$this->lesson_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,

            'points'        =>  $this->points,

            'image_one'     => $row && $row->image_one &&  Storage::disk('public')->exists($row->image_one)   ?   asset(Storage::url($row->image_one)) :null ,  

            'name'          => $row ? $row->name:'',

        ];        
    }
}
//