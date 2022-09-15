<?php

namespace App\Http\Resources\Dashboard\ControllerResources\MatchController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\Collections\ControllerResources\MatchController\MatchQuestionLanguagesCollection;

use App\Http\Resources\Dashboard\Collections\ControllerResources\MatchController\MatchAnswerCollection;

class MatchQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->match_question_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'              => $this->id,

            'degree'          => $this->degree, 

            'header'          => $row ? $row->header:'',

            'question_tags'   => $this->question_tags,

            'languages'       => new MatchQuestionLanguagesCollection ($this->match_question_languages),

            'match_answers'     => new MatchAnswerCollection ($this->match_answer),

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null
        ];        
    }
}
