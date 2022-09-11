<?php

namespace App\Http\Resources\Dashboard\ControllerResources\SubSubjectController;

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

            'name'          => $row ? $row->name:null,
            
            'image'        => $row && $row->image_one &&  Storage::disk('public')->exists($row->image_one)   ?   asset(Storage::url($row->image_one)) :null ,  

            
        ];        
    }
}
//