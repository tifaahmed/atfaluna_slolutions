<?php

namespace App\Http\Resources\Dashboard\Activity;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\Collections\Activity\ActivityLanguagesCollection;

use App\Http\Resources\Dashboard\Collections\Lesson\LessonCollection;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->activity_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,    

            'name'          => $row ? $row->name:'',

            'points'        => $this->points ,

            'languages'     => new ActivityLanguagesCollection ($this->activity_languages),

            'lesson'        =>  $this->lesson   ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];         
    }
}
//