<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
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
        $row=$this->lesson_languages()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'image'         => Storage::disk('public')->exists($this->image) ? Storage::url($this->image)  : null,
            'url'           => Storage::disk('public')->exists($this->url) ? Storage::url($this->url)  : null,
            'points'        =>  $this->points,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
            
            'name'          => $row ? $row->name:'',
            'languages'     => $this->Lesson_language,
        ];        
    }
}
//