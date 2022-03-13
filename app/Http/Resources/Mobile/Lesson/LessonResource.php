<?php

namespace App\Http\Resources\Mobile\Lesson;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\SubjectResource;
use App\Http\Resources\Mobile\LessonTypeResource;


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
            'name'          => $row ? $row->name:'',
            'image'          =>( $row && $row->image && Storage::disk('public')->exists($row->image) )? asset(Storage::url($row->image))  : null ,
            'url'           => $this->url,
            'points'        =>  $this->points,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'lesson_type'   => new LessonTypeResource (  $this->lesson_type )  ,

        ];        
    }
}
//