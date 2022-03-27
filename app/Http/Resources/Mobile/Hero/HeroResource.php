<?php

namespace App\Http\Resources\Mobile\Hero;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\Lesson\LessonResource;
use App\Http\Resources\Mobile\Collections\Hero\HeroLanguagesCollection;
use App\Http\Resources\Mobile\Collections\Lesson\LessonCollection;

use Illuminate\Http\Resources\Json\JsonResource;


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

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            
            'languages'     => new HeroLanguagesCollection ( $this->hero_languages ),
            'lessons'        => new LessonCollection ($this->herolesson)  ,



        ];        
    }
}
//