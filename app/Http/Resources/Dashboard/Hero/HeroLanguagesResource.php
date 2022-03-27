<?php

namespace App\Http\Resources\Dashboard\Hero;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class HeroLanguagesResource extends JsonResource
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
            'title'             => $this->title,
            'description'        => $this->description,
            'language'          => $this->language,
        ];        
    }
}
//
