<?php

namespace App\Http\Resources\Mobile\ControllerResources\AccessoryController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Basic;

use App\Http\Resources\Mobile\ControllerResources\AccessoryController\SkinResource;
use App\Http\Resources\Mobile\ControllerResources\AccessoryController\ActivityResource;
use App\Http\Resources\Mobile\ControllerResources\AccessoryController\LessonResource;

class AccessoryResource extends JsonResource
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
        $row=$this->accessory_languages()->Localization()->RelatedLanguage($this->id)->first();

        $taken = 0;
        $can_affort_it = 0;
        
        if (isset($request->sub_user_id) && $request->sub_user_id) {
            $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);
            $sub_user_accessory = $this->SubUserAccessory()->where('sub_user_id',$request->sub_user_id)->first();
            $taken = $sub_user_accessory ? 1 :0;
            $can_affort_it = ( $sub_user->points > $this->price ) ? 1 : 0 ;
        }

        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;
        $all += [ 'name'     =>  $row ? $row->name:'' ]  ;
        $all += [ 'description'     =>  $row ? $row->description:'' ]  ;
        $all += [ 'price'     =>  $this->price ]  ;
        $all += ['image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : asset(Storage::url($basic->item))];
        

        $all += [ 'taken'     => $taken ]  ; // user bought this before or not 
        $all += [ 'can_affort_it'     => $can_affort_it ]  ; // user have enough points ot not

        $all += [ 'accessory_skin'       => SkinResource::collection($this->AccessorySkin) ]  ; 
        $all += [ 'accessory_activity'     => ActivityResource::collection($this->AccessoryActivity) ]  ; 
        $all += [ 'accessory_lesson'     => LessonResource::collection($this->AccessoryLesson) ]  ; 
        
        return $all  ;      
    }
}
