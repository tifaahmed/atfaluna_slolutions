<?php

namespace App\Http\Resources\Mobile\Skill;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SkillLanguagesResource extends JsonResource
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
            'image'             => Storage::disk('public')->exists($this->image) ? Storage::url($this->image)  : null,
            'name'             => $this->name,
            'language'          => $this->language,
        ];        
    }
}
//
