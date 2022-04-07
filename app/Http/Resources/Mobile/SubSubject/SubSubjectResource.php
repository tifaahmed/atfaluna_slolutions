<?php

namespace App\Http\Resources\Mobile\SubSubject;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\SubjectResource;
use App\Http\Resources\Mobile\Collections\Lesson\LessonCollection;
use App\Http\Resources\Dashboard\Quiz\QuizResource;
use App\Models\Basic;

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
        $basic = Basic::find(1); //logo

        return [
            'id'            => $this->id,

            'name'               => $row ? $row->name:'',
            'description'        => $row ? $row->description:'',
            'image_one'          =>( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)),
            'image_two'          =>( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)),
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            // 'subject'       => $this->subject   ,
            'lessons'       => new LessonCollection ($this->lessons),
            'quiz'          => new QuizResource ($this->quiz)   ,

            
        ];        
    }
}
//
