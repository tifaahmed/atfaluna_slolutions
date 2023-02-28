<?php

namespace App\Http\Resources\Dashboard\ControllerResources\SubSubjectController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Collections\SubSubject\SubSubjectLanguagesCollection;


use App\Http\Resources\Dashboard\Collections\ControllerResources\SubSubjectController\LessonCollection;
use App\Http\Resources\Dashboard\Collections\ControllerResources\SubSubjectController\SkillCollection;

use App\Http\Resources\Dashboard\ControllerResources\SubSubjectController\LessonResource;
use App\Http\Resources\Dashboard\ControllerResources\SubSubjectController\QuizResource;
use App\Http\Resources\Dashboard\ControllerResources\SubSubjectController\SkillResource;
use App\Http\Resources\Dashboard\ControllerResources\SubSubjectController\SubjectResource;

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
            'points'        => $this->points,
        
            'languages'     => new SubSubjectLanguagesCollection ( $this->subSubject_languages ),

            'lessons'  => LessonResource::collection($this->lessons),

            'skills'   => SkillResource::collection($this->skills),

            'quiz'          =>   new QuizResource ($this->quiz)   ,

            'subject'          =>   new SubjectResource ($this->subject)   ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
//
