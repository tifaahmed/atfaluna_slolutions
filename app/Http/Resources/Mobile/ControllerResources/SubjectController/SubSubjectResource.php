<?php

namespace App\Http\Resources\Mobile\ControllerResources\SubjectController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

use App\Http\Resources\Mobile\Collections\ControllerResources\SubjectController\LessonCollection;

use App\Http\Resources\Mobile\ControllerResources\SubjectController\QuizResource;
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
        $sub_user_sub_subject = isset($request->sub_user_id) ? $this->sub_user_sub_subject->where('sub_user_id',$request->sub_user_id) : null ;

        return [
            'id'            => $this->id,

            'name'          => $row ? $row->name:'',
            'points'        => $this->points,
            'description'   => $row ? $row->description:'',
            'image_one'     => ( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)),
            'image_two'     => ( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)),

            'lessons'       => new LessonCollection ($this->lessons),
            'quiz'          => new QuizResource ($this->quiz)   ,

            'seen'          =>  ($sub_user_sub_subject && $sub_user_sub_subject->count()) > 0 ? 1 : 0,
            'sound'               =>  ( $row && $row->sound->count() &&   Storage::disk('public')->exists($row->sound[0]->record) ) ? asset(Storage::url($row->sound[0]->record))  :  null ,
            'sound_id'            =>  ( $row && $row->sound->count() ) ?  $row->sound[0]->id : null ,

            
        ];        
    }
}
//
