<?php

namespace App\Http\Resources\Dashboard\SubSubject;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\SubjectResource;
use App\Http\Resources\Dashboard\Collections\SubSubject\SubSubjectLanguagesCollection;
use App\Http\Resources\Dashboard\Collections\Lesson\LessonCollection;

use App\Http\Resources\Dashboard\Quiz\QuizResource;

class SubSubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->subSubject_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
            'languages'     => new SubSubjectLanguagesCollection ( $this->subSubject_languages ),

            'subject'       => $this->subject   ,
            'lessons'       => new LessonCollection ($this->lessons),
            'quiz'          =>   new QuizResource ($this->quiz)   ,
        ];        
    }
}
//
