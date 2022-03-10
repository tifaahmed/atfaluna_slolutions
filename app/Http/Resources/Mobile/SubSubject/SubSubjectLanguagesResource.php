<?php

namespace App\Http\Resources\Mobile\SubSubject;

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
            'image_one'             => Storage::disk('public')->exists($this->image_one) ? Storage::url($this->image_one)  : null,
            'image_two'             => Storage::disk('public')->exists($this->image_two) ? Storage::url($this->image_two)  : null,
            'name'              => $this->name,
            'subject'           => $this->subject,
            'language'          => $this->language,
            'sub_subject_id'    => $this->sub_subject_id,
        ];        
    }
}
//
