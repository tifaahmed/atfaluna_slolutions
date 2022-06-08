<?php

namespace App\Http\Resources\Dashboard\SubSubject;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\SoundsResource;

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
            'image_one'             => Storage::disk('public')->exists($this->image_one) ? asset(Storage::url($this->image_one))  : null,
            'image_two'             => Storage::disk('public')->exists($this->image_two) ? asset(Storage::url($this->image_two))  : null,
            'name'              => $this->name,
            'description'       => $this->description,
            'language'          => $this->language,
            'sound'          => SoundsResource::collection($this->sound),
        ];        
    }
}
//
