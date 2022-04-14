<?php

namespace App\Http\Resources\Mobile\QuizAttempt;

use Illuminate\Http\Resources\Json\JsonResource;

// use App\Http\Resources\Mobile\Collections\McqQuestion\McqQuestionCollection;
// use App\Http\Resources\Mobile\Collections\TrueFalseQuestion\TrueFalseQuestionCollection;
use App\Http\Resources\Mobile\Collections\QuestionAttempt\QuestionAttemptCollection;

use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

class QuizAttemptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id'            => $this->id,
            'score'        => $this->score,
            'status'          => $this->status,
            'question_attempts'          => new QuestionAttemptCollection( $this->question_attempt ),
        ];        
    }
}
//