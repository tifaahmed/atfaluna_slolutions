<?php

namespace App\Http\Resources\Dashboard\ControllerResources\MatchAnswerController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MatchAnswerLanguagesResource extends JsonResource
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
            
            'audio'             => Storage::disk('public')->exists($this->audio) ? asset(Storage::url($this->audio))  : null,
            'title'             => $this->title,
            'language'          => $this->language,
        ];        
    }
}
//
