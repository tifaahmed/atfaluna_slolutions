<?php

namespace App\Http\Resources\Mobile\ControllerResources\SubjectController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

use App\Http\Resources\Mobile\LessonTypeResource;

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

        $sub_user_lesson = isset($request->sub_user_id) ? $this->sub_user_lesson->where('sub_user_id',$request->sub_user_id) : null ;
        
        $have_assigments = 0;
        $have_quizs = 0;
        if ( $this->quiz->where('quiz_type',1)->first()  ) {
            $have_assigments = 1 ;
        }else if($this->quiz->where('quiz_type',2)->first()){
            $have_quizs = 1 ;
        }
        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'points'        =>  $this->points,

            'image'         =>( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)),
            'url'           =>( $row && $row->url       && Storage::disk('public')->exists($row->url) )? asset(Storage::url($row->url))  : asset(Storage::url($basic->item)),

            'seen'          => ( $sub_user_lesson && $sub_user_lesson->count() ) > 0 ? 1 : 0,

            'have_activities' => ( $this->activities && $this->activities->count() > 0 ) ? 1 : 0 ,
            
            'have_quizs' => $have_quizs ,
            'have_quizs' => $have_assigments ,

            'lesson_type'   => new LessonTypeResource (  $this->lesson_type )  ,

        ];        
    }
}
//