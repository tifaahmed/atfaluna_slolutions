<?php
namespace App\Http\Resources\Mobile\ControllerResources\AchievementController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;
use Illuminate\Support\Facades\Auth;

class AchievementImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $basic = Basic::find(1);
        if (isset($request->sub_user_id) && $request->sub_user_id) {
            $sub_user       = Auth::user()->sub_user()->find($request->sub_user_id);
            $reached = 0 ;
            $reached_points = 0; 
            if ($this->achievement->id == 1 ) {
                $reached_points    = $sub_user->subUserLesson()->where('lesson_type_id',1)->count();
                if ($reached_points >=$this->points ) {
                    $reached     =  1  ;
                }
            }
            if ($this->achievement->id == 2 ) {
                $reached_points    = $sub_user->subUserLesson()->where('lesson_type_id',2)->count();
                if ($reached_points >=$this->points ) {
                    $reached     =  1  ;
                }
            }
            if ($this->achievement->id == 3 ) {
                $reached_points    = $sub_user->subUserActivity()->count();
                if ($reached_points >=$this->points ) {
                    $reached     =  1  ;
                }
            }
            if ($this->achievement->id == 4 ) {
                $reached_points    = $sub_user->subUserAvatar()->count();
                if ($reached_points >=$this->points ) {
                    $reached     =  1  ;
                }
            }
            if ($this->achievement->id == 5 ) {
                $reached_points    = $sub_user->subUserQuiz()->where('quiz_type_id',1)->count();
                if ($reached_points >=$this->points ) {
                    $reached     =  1  ;
                }
            }
            if ($this->achievement->id == 6 ) {
                $reached_points    = $sub_user->subUserQuiz()->where('quiz_type_id',2)->count();
                if ($reached_points >=$this->points ) {
                    $reached     =  1  ;
                }
            }
            if ($this->achievement->id == 7 ) {
                $reached_points    = $sub_user->subUserAccessory()->count();
                if ($reached_points >=$this->points ) {
                    $reached     =  1  ;
                }
            }
        }


        return [
            'id'                => $this->id,
            'points'            =>  $this->points,
            'reached_points'            =>  $reached_points,

            'image'          => 
                ( !$reached ) ? 
                    ( 
                        ( Storage::disk('public')->exists($this->image_one) )? 
                        asset(Storage::url($this->image_one))  
                        : 
                        asset(Storage::url($basic->item)) 
                    ) 
                    : 
                    ( 
                        ( Storage::disk('public')->exists($this->image_two) )? 
                        asset(Storage::url($this->image_two))  
                        : 
                        asset(Storage::url($basic->item)) 
                    ) 
            ,

        ];        
    }
}

