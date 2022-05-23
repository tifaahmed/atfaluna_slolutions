<?php

namespace App\Http\Resources\Dashboard\Achievement;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AchievementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->achievement_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'description'   => $row ? $row->description:'',
            'language'      => $row ? $row->language:'',
            'count'         => $this->count,
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

        ];        
    }
}
