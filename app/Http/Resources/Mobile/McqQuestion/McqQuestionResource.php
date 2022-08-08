<?php

namespace App\Http\Resources\Mobile\McqQuestion;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;
use App\Http\Resources\Mobile\Collections\McqAnswer\McqAnswerCollection;

class McqQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->mcq_question_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1);

        return [
            'type'       => ' McqQuestion',

            'id'                  => $this->id,
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            
            'video'             => $row && Storage::disk('public')->exists($row->video) ? asset(Storage::url($row->video)) : null,
            'audio'             => $row && Storage::disk('public')->exists($row->audio) ? asset(Storage::url($row->audio)) : null,
            'title'             => $row ? $row->title : null,
            'header'            => $row ? $row->header : null,
            'language'          => $row ? $row->language : null,

            'mcq_answers'     => new McqAnswerCollection ($this->mcq_answer),

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }
}
