<?php

namespace App\Http\Resources\Dashboard\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\SubjectResource;
use App\Http\Resources\Dashboard\McqQuestionResource;
use App\Http\Resources\Dashboard\TrueFalseQuestionResource;


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

            'languages'     => $this->quiz_languages,
            'name'          => $row ? $row->name:'',

            'subject'       => new SubjectResource ( $this->subject )  ,

            'true_false_questions'        => new TrueFalseQuestionResource ($this->quizTrueOrFalseQuestion)  ,
            'mcq_questions'               => new McqQuestionResource ($this->quizMcqQuestion)  ,

        ];        
    }
}
//