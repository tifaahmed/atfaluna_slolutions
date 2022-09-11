<?php

namespace App\Http\Resources\Dashboard\Lesson;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\LessonTypeResource;

use App\Http\Resources\Dashboard\Collections\Lesson\LessonLanguagesCollection;
use App\Http\Resources\Dashboard\Collections\Quiz\QuizCollection;
use App\Http\Resources\Dashboard\Collections\Skill\SkillCollection ;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\Quiz\QuizResource;


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
            'image_one'        => $row && $row->image_one &&  Storage::disk('public')->exists($row->image_one)   ?   asset(Storage::url($row->image_one)) :null ,  
            'name'          => $row ? $row->name:'',

            'languages'     => new LessonLanguagesCollection ( $this->lesson_languages()->orderBy('language')->get() ),

            'sub_subject'   => $this->subSubject   ,

            'quiz'          =>  QuizResource::collection ($this->quiz)  ,

            'lesson_type'   => new LessonTypeResource (  $this->lesson_type )  ,

            'skills'        => new SkillCollection($this->skills),

            // 'quiz'       =>    $this->quiz    ,

            
        ];        
    }
}
//