<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\QuizResource;

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

        return [
            'id'                  => $this->id,
            'image'         => Storage::disk('public')->exists($this->image) ? Storage::url($this->image)  : null,
            'videos'        => Storage::disk('public')->exists($this->videos) ? Storage::url($this->videos)  : null,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'languages'     => $this->Mcq_question_language,
            'name'          => $row ? $row->name:'',

            'quiz'          => new QuizResource (  $this->quiz )  ,
        ];        
    }
}
