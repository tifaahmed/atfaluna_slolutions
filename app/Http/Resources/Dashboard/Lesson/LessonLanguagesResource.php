<?php

namespace App\Http\Resources\Dashboard\Lesson;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LessonLanguagesResource extends JsonResource
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
            'image_one'         => Storage::disk('public')->exists($this->image_one) ? asset(Storage::url($this->image_one))  : null,
            'image_two'         => Storage::disk('public')->exists($this->image_two) ? asset(Storage::url($this->image_two))  : null,
            'name'              => $this->name,
            'language'          => $this->language,
            'url'               => Storage::disk('public')->exists($this->url) ? asset(Storage::url($this->url))  : null,
        ];        
    }
}
//
