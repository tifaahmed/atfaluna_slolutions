<?php

namespace App\Http\Resources\Dashboard\ControllerResources\QuizController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\Collections\Quiz\QuizLanguagesCollection;

use App\Http\Resources\Dashboard\ControllerResources\QuizController\QuizTypeResource;
use App\Http\Resources\Dashboard\ControllerResources\QuizController\McqQuestionResource;
use App\Http\Resources\Dashboard\ControllerResources\QuizController\MatchQuestionResource;
use App\Http\Resources\Dashboard\ControllerResources\QuizController\TrueFalseQuestionResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->quiz_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'points'        => $this->points,
            'minimum_requirements'   => $this->minimum_requirements,
            'name'          => $row ? $row->name:'',
            'languages'     => new QuizLanguagesCollection  ($this->quiz_languages) ,

            'quiz_type'   => new QuizTypeResource (  $this->quiz_type )  ,

            'mcq_questions'          =>  McqQuestionResource::collection ($this->mcq_questions)  ,

            'true_false_questions'   =>  TrueFalseQuestionResource::collection ($this->true_false_questions)  ,

            'match_questions'   =>  MatchQuestionResource::collection ($this->match_questions)  ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }   
}
