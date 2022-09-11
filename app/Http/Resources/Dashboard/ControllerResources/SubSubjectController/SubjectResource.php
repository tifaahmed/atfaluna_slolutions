<?php

namespace App\Http\Resources\Dashboard\ControllerResources\SubSubjectController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row = $this->subject_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,

            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            
            'name'          => $row ? $row->name:'',

            'points'        => $this->points,

        ];        
    }
}

