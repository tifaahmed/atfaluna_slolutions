<?php

namespace App\Http\Resources\Dashboard\ControllerResources\McqAnswerController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\Collections\McqAnswer\McqAnswerLanguagesCollection;
use App\Http\Resources\Dashboard\ControllerResources\McqAnswerController\McqQuestionResource;

class McqAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->mcq_answer_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            'answer'        =>  $this->answer,

            'title'          => $row ? $row->title:'',

            'languages'     => new McqAnswerLanguagesCollection ($this->mcq_answer_languages),

            'mcq_question'    => new McqQuestionResource ($this->mcq_question),

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
//