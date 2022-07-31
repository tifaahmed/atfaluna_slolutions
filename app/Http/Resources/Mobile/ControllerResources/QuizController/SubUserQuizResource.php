<?php

namespace App\Http\Resources\Mobile\ControllerResources\QuizController;

use Illuminate\Http\Resources\Json\JsonResource;

// use App\Http\Resources\Mobile\Collections\ControllerResources\SubjectController\QuizAttemptCollection;
use App\Http\Resources\Mobile\ControllerResources\QuizController\QuizAttemptResource;

class SubUserQuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $quiz_attempts = $this->quiz_attempts->where('status', 'closed')->sortBy('score');
        return [
            'id'          => $this->id,
            'score'       => $this->score,
            'pass'        => $this->pass,
            'quiz_attempts'        => QuizAttemptResource::collection ($quiz_attempts),

        ];        
    }
}
//
