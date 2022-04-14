<?php

namespace App\Http\Resources\Mobile\QuestionAttempt;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Mobile\McqQuestion\McqQuestionResource;
use App\Http\Resources\Mobile\TrueFalseQuestion\TrueFalseQuestionResource;

use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

class QuestionAttemptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $all = [];
        $all += array('id'                => $this->id);
        $all += array('quiz_attempt_id'   => $this->quiz_attempt_id);
        $all += array('status'            => $this->status);
        $all += array('answer'            => $this->answer);

        if( $this->questionable_type == 'App\Models\True_false_question' ){
            $all += array('questionable'            => new TrueFalseQuestionResource ( $this->questionable ) );
        }else if( $this->questionable_type == 'App\Models\Mcq_question' ){
            $all += array('questionable'            => new McqQuestionResource ( $this->questionable ) );
        }
        return $all;  
    }
}
//