<?php
namespace App\Http\Resources\Mobile\ControllerResources\AchievementController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\ControllerResources\AchievementController\AchievementImageResource ;
use Illuminate\Support\Facades\Auth;

class AchievementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->achievement_languages()->Localization()->RelatedLanguage($this->id)->first();
        $sub_user       = Auth::user()->sub_user()->find($request->sub_user_id);
        $reached_points = 0; 
        $main_achivement_image = null ; 
        if ($this->id == 1 ) {
            $reached_points    = $sub_user->subUserLesson()->where('lesson_type_id',1)->count();
            $main_achivement_image = $this->achivementImages->where('points',">=",$reached_points)->first();
        }
        if ($this->id == 2 ) {
            $reached_points    = $sub_user->subUserLesson()->where('lesson_type_id',2)->count();
            $main_achivement_image = $this->achivementImages->where('points',">=",$reached_points)->first();
        }
        if ($this->id == 3 ) {
            $reached_points    = $sub_user->subUserActivity()->count();
            $main_achivement_image = $this->achivementImages->where('points',">=",$reached_points)->first();
        }
        if ($this->id == 4 ) {
            $reached_points    = $sub_user->subUserAvatar()->count();
            $main_achivement_image = $this->achivementImages->where('points',">=",$reached_points)->first();
        }
        if ($this->id == 5 ) {
            $reached_points    = $sub_user->subUserQuiz()->where('quiz_type_id',1)->count();
            $main_achivement_image = $this->achivementImages->where('points',">=",$reached_points)->first();
        }
        if ($this->id == 6 ) {
            $reached_points    = $sub_user->subUserQuiz()->where('quiz_type_id',2)->count();
            $main_achivement_image = $this->achivementImages->where('points',">=",$reached_points)->first();
        }
        if ($this->id == 7 ) {
            $reached_points    = $sub_user->subUserAccessory()->count();
            $main_achivement_image = $this->achivementImages->where('points',">=",$reached_points)->first();
        }


        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'description'   => $row ? $row->description:'',
            'language'      => $row ? $row->language:'',
            'reached_points' => $reached_points,
            'achivement_images'      => AchievementImageResource::collection($this->achivementImages),

            'main_achivement_image' => $main_achivement_image ?  new AchievementImageResource($main_achivement_image) : null ,
        ];        
    }
}
