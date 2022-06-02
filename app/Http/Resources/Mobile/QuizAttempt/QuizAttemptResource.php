<?php

namespace App\Http\Resources\Mobile\QuizAttempt;

use Illuminate\Http\Resources\Json\JsonResource;

// use App\Http\Resources\Mobile\Collections\McqQuestion\McqQuestionCollection;
// use App\Http\Resources\Mobile\Collections\TrueFalseQuestion\TrueFalseQuestionCollection;
use App\Http\Resources\Mobile\Collections\QuestionAttempt\QuestionAttemptCollection;

use Illuminate\Support\Facades\Storage;

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
        // $sub_user_quiz = $this->sub_user_quiz;
        // $sub_user_quiz =  Sub_user_quiz::where('id',3)->first();
        $sub_user_quiz_array  =  $this->sub_user_quiz->quiz_attempts()->get()->pluck('id')->toArray();
        $foundIndex = array_search($this->id, $sub_user_quiz_array);

        $full_mark = 0;
        foreach ($this->question_attempts as $key => $question_attempt) {
            $full_mark =  $full_mark + $question_attempt->questionable->degree;
        }

        return [
            'id'                => $this->id,
            'quiz_attempts_count '             => $foundIndex+1 ,
            'score'             => $this->score,
            'status'            => $this->status,
            'full_mark'            => $full_mark,
            'question_attempts' => new QuestionAttemptCollection( $this->question_attempts ),
        ];        
    }
}
//