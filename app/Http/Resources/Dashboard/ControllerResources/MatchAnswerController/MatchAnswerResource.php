<?php

namespace App\Http\Resources\Dashboard\ControllerResources\MatchAnswerController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\Collections\ControllerResources\MatchAnswerController\MatchAnswerLanguagesCollection;

use App\Http\Resources\Dashboard\ControllerResources\MatchAnswerController\MatchQuestionResource;

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

            'id'            => $this->id,

            'title'         => $row ? $row->title:'',

            'possition'     => $this->possition,

            'match_answer_id'         =>  $this->match_answer_id ,

            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,

            'languages'     => new MatchAnswerLanguagesCollection ($this->match_answer_languages),

            // 'match_answer'      =>  $this->match_answer  ,

            'match_question'    => new MatchQuestionResource ($this->match_question),

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
//