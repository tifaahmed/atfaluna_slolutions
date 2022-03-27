<?php

namespace App\Http\Resources\Dashboard\McqQuestion;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\Collections\McqQuestion\McqQuestionLanguagesCollection;
use App\Http\Resources\Dashboard\Collections\McqAnswer\McqAnswerCollection;

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
            'image'         => Storage::disk('public')->exists($this->image) ? Storage::url($this->image)  : null,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'languages'     => new McqQuestionLanguagesCollection ($this->mcq_question_languages),
            'title'          => $row ? $row->title:'',

            'mcq_answers'     => new McqAnswerCollection ($this->mcq_answer),

        ];        
    }
}
