<?php

namespace App\Http\Resources\Dashboard\Lesson;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\SubjectResource;
use App\Http\Resources\Dashboard\LessonTypeResource;

use App\Http\Resources\Dashboard\Collections\Lesson\LessonLanguagesCollection;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    $row=$this->lesson_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            // 'image'         => Storage::disk('public')->exists($this->image) ? Storage::url($this->image)  : null,
            'url'           => $this->url,
            'points'        =>  $this->points,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'languages'     => new LessonLanguagesCollection ( $this->lesson_languages ),

            'name'          => $row ? $row->name:'',
            
            'subject'       => new SubjectResource (  $this->subject )  ,
            'lesson_type'   => new LessonTypeResource (  $this->lesson_type )  ,

        ];        
    }
}
//