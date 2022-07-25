<?php

namespace App\Http\Resources\Mobile\MatchAnswer;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
// use App\Http\Resources\Mobile\McqQuestion\McqQuestionResource;
use App\Http\Resources\Mobile\Collections\MatchAnswer\MatchAnswerLanguagesCollection;

class MatchAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->match_answer_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'             => $this->id,
            'match_answer_id'=> $this->match_answer_id,
            'image'          => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : asset(Storage::url($basic->item)),
            'possition'      =>  $this->possition,

            'title'         => $row ? $row->title : '',
            'audio'         => ( $row && Storage::disk('public')->exists($row->audio)) ? asset(Storage::url($row->audio))  : null,
        ];        
    }
}
//