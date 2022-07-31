<?php
namespace App\Http\Resources\Mobile\ControllerResources\QuizController;

use Illuminate\Http\Resources\Json\JsonResource;


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

        return [
            'id'                => $this->id,
            'quiz_attempts_count '             => $foundIndex+1 ,
            'score'             => $this->score,
            'status'            => $this->status,
        ];        
    }
}
//