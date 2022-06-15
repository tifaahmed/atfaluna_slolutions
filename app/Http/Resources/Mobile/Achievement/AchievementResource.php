<?php

namespace App\Http\Resources\Mobile\Achievement;

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

        ];        
    }
}
