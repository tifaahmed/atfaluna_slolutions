<?php

namespace App\Http\Resources\Mobile\ControllerResources\HeroController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\ControllerResources\HeroController\LessonTypeResource;
// use App\Http\Resources\Mobile\Collections\ControllerResources\HeroController\QuizCollection;

use App\Models\Basic;
use App\Models\Accessory;
use Illuminate\Database\Eloquent\Builder;

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

        $sub_user_lesson = isset($request->sub_user_id) ? $this->subUserLesson()->where('sub_user_id',$request->sub_user_id)->first() : null ;

        $sub_user_id = $request->sub_user_id ;
        $sub_user_accessories = 
            isset($request->sub_user_id) 
            ?
                Accessory::
                whereHas('SubUserAccessory', function (Builder $query)   use($sub_user_id) {
                    $query->where('sub_user_id',$sub_user_id);
                })
                ->
                whereHas('AccessoryLesson', function (Builder $query)   use($sub_user_id) {
                    $query->where('lesson_id',$this->id);
                })
                ->
                get()->pluck('id')->toArray() 
            :
                [];


        $have_activities = 0;
        if($this->activities && $this->activities->count() > 0 ){
            $have_activities = 1 ;
        }
        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'image_one'     =>( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)),
            'image_two'     =>( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)),
            'url'           =>( $row && $row->url       && Storage::disk('public')->exists($row->url) )? asset(Storage::url($row->url))  : asset(Storage::url($basic->item)),

            'points'        =>  $this->points,

            'lesson_type'   => new LessonTypeResource (  $this->lesson_type )  ,
            'have_activities' =>$have_activities,
            'sub_user_accessories' => $sub_user_accessories ,
            'game_data'          => $sub_user_lesson ? $sub_user_lesson->pivot->game_data : null,

        ];        
    }
}
