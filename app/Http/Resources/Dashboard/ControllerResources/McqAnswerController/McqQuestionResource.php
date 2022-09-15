<?php

namespace App\Http\Resources\Dashboard\ControllerResources\McqAnswerController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class McqQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->mcq_question_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'                  => $this->id,

            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,

            'degree'          => $this->degree,

            'level'          => $this->level,

            'title'          => $row ? $row->title:'',

            'question_tags'     => $this->question_tags,

        ];        
    }
}
