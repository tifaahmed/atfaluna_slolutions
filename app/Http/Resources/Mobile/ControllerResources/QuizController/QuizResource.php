<?php

namespace App\Http\Resources\Mobile\ControllerResources\QuizController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Mobile\ControllerResources\QuizController\SubUserQuizResource;

// use App\Http\Resources\Mobile\Collections\TrueFalseQuestion\TrueFalseQuestionCollection;

use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->quiz_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1); //logo
        $sub_user_quizzes = isset($request->sub_user_id) ? $this->sub_user_quizzes->where('sub_user_id',$request->sub_user_id) : null ;
        

        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;
        if ($sub_user_quizzes && $sub_user_quizzes->count() <= 0) {
            $all += [ 'image'     => ($row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item))  ]  ;
        }else{
            $all += [ 'image'     => ($row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item))  ]  ;
        }
        $all += [ 'name'     =>  $row ? $row->name:'' ]  ;
        $all += [ 'points'     =>  $this->points ]  ;
        $all += [ 'minimum_requirements'     =>  $this->minimum_requirements ]  ;
        $all += [ 'sub_user_quizzes'     =>  $sub_user_quizzes ? SubUserQuizResource::collection($sub_user_quizzes) : [] ]  ;
        $all += [ 'seen'     =>  ($sub_user_quizzes && $sub_user_quizzes->count()) > 0 ? 1 : 0 ]  ;

        return $all; 
    }
}
//