<?php

namespace App\Http\Resources\Dashboard\McqQuestion;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class McqQuestionLanguagesResource extends JsonResource
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
            
            'video'             => Storage::disk('public')->exists($this->video) ? Storage::url($this->video)  : null,
            'audio'             => Storage::disk('public')->exists($this->audio) ? Storage::url($this->audio)  : null,
            'title'             => $this->title,
            'header'            => $this->header,
            'language'          => $this->language,
        ];        
    }
}
//
