<?php

namespace App\Http\Resources\Dashboard\SubSubject;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SubSubjectLanguagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id'                => $this->id,
            'image'             => Storage::disk('public')->exists($this->image) ? Storage::url($this->image)  : null,
            'name'              => $this->name,
            'subject'           => $this->subject,
            'language'          => $this->language,
            'sub_subject_id'    => $this->sub_subject_id,
        ];        
    }
}
//
