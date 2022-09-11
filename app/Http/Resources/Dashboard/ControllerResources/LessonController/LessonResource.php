<?php

namespace App\Http\Resources\Dashboard\ControllerResources\LessonController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

use App\Http\Resources\Dashboard\Collections\Lesson\LessonLanguagesCollection;
use App\Http\Resources\Dashboard\ControllerResources\LessonController\LessonTypeResource;
use App\Http\Resources\Dashboard\ControllerResources\LessonController\QuizResource;
use App\Http\Resources\Dashboard\ControllerResources\LessonController\SubSubjectResource;
use App\Http\Resources\Dashboard\ControllerResources\LessonController\SkillResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    $row=$this->lesson_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'points'        =>  $this->points,
            'image_one'        => $row && $row->image_one &&  Storage::disk('public')->exists($row->image_one)   ?   asset(Storage::url($row->image_one)) :null ,  
            'name'          => $row ? $row->name:'',

            'languages'     => new LessonLanguagesCollection ( $this->lesson_languages()->orderBy('language')->get() ),
            
            'sub_subject'   =>   new SubSubjectResource ( $this->subSubject )   ,

            'lesson_type'   => new LessonTypeResource (  $this->lesson_type )  ,

            'skills'          =>  SkillResource::collection ($this->skills)  ,

            'quiz'          =>  QuizResource::collection ($this->quiz)  ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }
}
//