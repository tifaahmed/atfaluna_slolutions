<?php

namespace App\Http\Resources\Dashboard\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\SubjectResource;

use App\Http\Resources\Dashboard\Collections\Quiz\QuizLanguagesCollection;

use App\Http\Resources\Dashboard\McqQuestion\McqQuestionResource;
use App\Http\Resources\Dashboard\TrueFalseQuestion\TrueFalseQuestionResource;
use App\Http\Resources\Dashboard\MatchQuestion\MatchQuestionResource;

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

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'languages'     => new QuizLanguagesCollection  ($this->quiz_languages) ,
            'name'          => $row ? $row->name:'',

            
            // 'quizable'       =>  $this->quizable  ,

            'mcq_questions'          =>  McqQuestionResource::collection ($this->mcq_questions)  ,
            'true_false_questions'   =>  TrueFalseQuestionResource::collection ($this->true_false_questions)  ,
            'match_questions'   =>  MatchQuestionResource::collection ($this->match_questions)  ,
        ];        
    }
}
//