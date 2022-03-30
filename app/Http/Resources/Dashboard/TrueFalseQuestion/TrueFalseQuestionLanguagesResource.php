<?php

namespace App\Http\Resources\Dashboard\TrueFalseQuestion;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TrueFalseQuestionLanguagesResource extends JsonResource
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
            
            'video'             => Storage::disk('public')->exists($this->video) ? asset(Storage::url($this->video))  : null,
            'audio'             => Storage::disk('public')->exists($this->audio) ? asset(Storage::url($this->audio))  : null,
            'title'             => $this->title,
            'header'            => $this->header,
            'language'          => $this->language,
        ];        
    }
}
//
