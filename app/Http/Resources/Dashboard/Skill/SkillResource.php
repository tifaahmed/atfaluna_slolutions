<?php

namespace App\Http\Resources\Dashboard\Skill;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Skill\SkillLanguagesResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    $row=$this->skill_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'languages'     => SkillLanguagesResource::collection ( $this->skill_languages ),
        ];        
    }
}
//