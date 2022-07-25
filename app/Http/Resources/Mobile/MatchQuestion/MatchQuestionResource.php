<?php

namespace App\Http\Resources\Mobile\MatchQuestion;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
// use App\Http\Resources\Mobile\Collections\MatchQuestion\MatchQuestionLanguagesCollection;
// use App\Http\Resources\Mobile\Collections\MatchAnswer\MatchAnswerCollection;
use App\Http\Resources\Mobile\MatchAnswer\MatchAnswerResource;

class MatchQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->match_question_languages()->Localization()->RelatedLanguage($this->id)->first();
        // return $this->match_answer()->orderBy('possition')->get();
        return [
            'type'       => ' MatchQuestion',

            'id'              => $this->id,
            'degree'          => $this->degree, 

            'header'          => $row ? $row->header:'',
            'audio'          => $row ? $row->audio:'',


            'match_answers'     =>  MatchAnswerResource::collection($this->match_answer()->orderBy('possition')->get() ),

            // 'question_tags'   => $this->question_tags,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null
        ];        
    }
}
