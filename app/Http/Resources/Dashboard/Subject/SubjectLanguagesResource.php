<?php

namespace App\Http\Resources\Dashboard\Subject;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\SoundsResource;
class SubjectLanguagesResource extends JsonResource
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
            'id' => $this->id,
            'name'             => $this->name,
            'language'          => $this->language,
            'sound'          => SoundsResource::collection($this->sound),
        ];        
    }
}
//
