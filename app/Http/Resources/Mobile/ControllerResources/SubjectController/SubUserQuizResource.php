<?php

namespace App\Http\Resources\Mobile\ControllerResources\SubjectController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Mobile\Collections\ControllerResources\SubjectController\QuizAttemptCollection;

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
            'quiz_attempts'        => new QuizAttemptCollection ($quiz_attempts),
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            // 'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            // 'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
//
