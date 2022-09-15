<?php

namespace App\Http\Resources\Dashboard\ControllerResources\McqQuestionController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\Collections\McqQuestion\McqQuestionLanguagesCollection;
use App\Http\Resources\Dashboard\ControllerResources\McqQuestionController\McqAnswerResource;

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

            'languages'     => new McqQuestionLanguagesCollection ($this->mcq_question_languages),


            'mcq_answers'          =>  McqAnswerResource::collection ($this->mcq_answer)  ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }
}
