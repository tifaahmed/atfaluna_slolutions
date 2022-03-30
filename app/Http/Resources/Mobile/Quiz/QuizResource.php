<?php

namespace App\Http\Resources\Mobile\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Mobile\Collections\McqQuestionCollection;
use App\Http\Resources\Mobile\Collections\TrueFalseQuestionCollection;

use Illuminate\Support\Facades\Storage;

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

            'image'          =>( $row && $row->image && Storage::disk('public')->exists($row->image) )? asset(Storage::url($row->image))  : null ,
            'name'          => $row ? $row->name:'',
            'points'        => $this->points,

            'mcq_questions'          =>   $this->mcq_questions    ,
            // 'true_false_questions'   =>   $this->true_false_questions    ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

        ];        
    }
}
//