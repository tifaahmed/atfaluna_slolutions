<?php

namespace App\Http\Resources\Mobile\McqAnswer;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

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
        $basic = Basic::find(1);

        return [
            'id'            => $this->id,
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            'answer'        =>  $this->answer,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'title'         => $row ? $row->title : '',
            'audio'         => ( $row && Storage::disk('public')->exists($row->audio)) ? asset(Storage::url($row->audio))  : null,
            'languages'     => $row ? $row->language : '',

        ];        
    }
}
//