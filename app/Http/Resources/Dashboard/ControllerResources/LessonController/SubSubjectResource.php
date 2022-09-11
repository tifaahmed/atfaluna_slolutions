<?php

namespace App\Http\Resources\Dashboard\ControllerResources\LessonController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class SubSubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->subSubject_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'image_one'        => $row && $row->image_one &&  Storage::disk('public')->exists($row->image_one)   ?   asset(Storage::url($row->image_one)) :null ,  
            'image_two'     => $row && $row->image_two &&  Storage::disk('public')->exists($row->image_two)   ?   asset(Storage::url($row->image_two)) :null ,  
        ];        
    }
}
//
