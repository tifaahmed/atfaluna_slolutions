<?php

namespace App\Http\Resources\Dashboard\ControllerResources\QuizController;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'header'          => $row ? $row->header:'',
        ];        
    }
}
