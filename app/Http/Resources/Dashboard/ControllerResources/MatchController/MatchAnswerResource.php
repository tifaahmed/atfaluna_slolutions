<?php

namespace App\Http\Resources\Dashboard\ControllerResources\MatchController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\Collections\ControllerResources\MatchController\MatchAnswerLanguagesCollection;

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
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,

            'title'          => $row ? $row->title:'',

            // 'answer'        =>  $this->answer,

            'languages'     => new MatchAnswerLanguagesCollection ($this->match_answer_languages),
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
