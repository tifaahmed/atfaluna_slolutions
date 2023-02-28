<?php

namespace App\Http\Resources\Dashboard\ControllerResources\HeroController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\ControllerResources\HeroController\LessonResource;

use App\Http\Resources\Dashboard\Collections\Hero\HeroLanguagesCollection;

class HeroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    $row=$this->hero_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'title'          => $row ? $row->title:'',

            'languages'     => new HeroLanguagesCollection ( $this->hero_languages ),

            // 'lessons'        => new LessonCollection ($this->herolesson)  ,
            'hero_lesson'     => LessonResource::collection($this->herolesson)  ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }
}
//