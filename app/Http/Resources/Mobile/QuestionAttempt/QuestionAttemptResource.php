<?php

namespace App\Http\Resources\Mobile\QuestionAttempt;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Mobile\McqQuestion\McqQuestionResource;
use App\Http\Resources\Mobile\TrueFalseQuestion\TrueFalseQuestionResource;
use App\Http\Resources\Mobile\MatchQuestion\MatchQuestionResource;

use Illuminate\Support\Facades\Storage;
use App\Models\Basic;
use App\Models\True_false_question;
use App\Models\Mcq_question;
use App\Models\Match_question;

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
        // $all += array('quiz_attempt_id'   => $this->quiz_attempt_id);
        $all += array('degree'            => $this->questionable->degree);
        $all += array('status'            => $this->status);
        $all += array('answer'            => $this->answer);

        if( $this->questionable_type == True_false_question::class ){
            $all += array('questionable'            => new TrueFalseQuestionResource ( $this->questionable ) );
        }else if( $this->questionable_type == Mcq_question::class  ){
            $all += array('questionable'            => new McqQuestionResource ( $this->questionable ) );
        }else if( $this->questionable_type == Match_question::class  ){
            $all += array('questionable'            => new MatchQuestionResource ( $this->questionable ) );
        } 
        return $all;  
    }
}
//