<?php

namespace App\Http\Resources\Dashboard\Lesson;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\LessonTypeResource;

use App\Http\Resources\Dashboard\Collections\Lesson\LessonLanguagesCollection;
use App\Http\Resources\Dashboard\Collections\Quiz\QuizCollection;
use App\Http\Resources\Dashboard\Collections\Skill\SkillCollection ;


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

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'languages'     => new LessonLanguagesCollection ( $this->lesson_languages ),
            'name'          => $row ? $row->name:'',
            
            'sub_subject'   => $this->subSubject   ,
            'lesson_type'   => new LessonTypeResource (  $this->lesson_type )  ,

            'skills'        => new SkillCollection($this->skills),

            'quiz'       =>    $this->quiz    ,

            
        ];        
    }
}
//