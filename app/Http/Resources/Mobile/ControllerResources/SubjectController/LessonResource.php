<?php

namespace App\Http\Resources\Mobile\ControllerResources\SubjectController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\SubjectResource;
use App\Http\Resources\Mobile\LessonTypeResource;
// use App\Http\Resources\Mobile\ControllerResources\SubjectController\QuizResource;
use App\Http\Resources\Dashboard\Collections\Quiz\QuizCollection;

use App\Models\Basic;

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
        $basic = Basic::find(1);

        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'image_one'     =>( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)),
            'image_two'     =>( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)),
            'url'           =>( $row && $row->url       && Storage::disk('public')->exists($row->url) )? asset(Storage::url($row->url))  : asset(Storage::url($basic->item)),

            'points'        =>  $this->points,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            // 'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            // 'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'lesson_type'   => new LessonTypeResource (  $this->lesson_type )  ,
            // 'sub_subject'   => $this->subSubject   ,
            'quiz'          =>   new QuizCollection ($this->quiz)   ,

        ];        
    }
}
//