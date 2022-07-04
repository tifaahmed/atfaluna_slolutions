<?php

namespace App\Http\Resources\Mobile\ControllerResources\subuserController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\ControllerResources\subuserController\PlayTimeResource;
use App\Http\Resources\Mobile\ControllerResources\subuserController\AgeGroupResource;

use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

use Carbon\Carbon;

class SubUserResource extends JsonResource
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

        $SubUserSubscription = $this->SubUserSubscriptions()->first();

        $subscription_status = 0 ;
        if (
            $SubUserSubscription && 
            $SubUserSubscription->start <= Carbon::now() && 
            $SubUserSubscription->end >= Carbon::now() 
        ) {
            $subscription_status = 1 ;
        }
        $subUserAvatarActive = $this->subUserAvatarActive()->first();
        $image = $subUserAvatarActive ?  $subUserAvatarActive->skins()->Original()->first()->image : null;
        


        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'age'           => $this->age,
            'gender'        => $this->gender,
            'points'        => $this->points,

            'avatar'        =>  Storage::disk('public')->exists($image) ? asset(Storage::url($image))  : asset(Storage::url($basic->item)) ,
            'play_time'        =>  PlayTimeResource::collection($this->playTime)  ,
            'age_groups'         =>  AgeGroupResource::collection($this->subUserAgeGroup ) ,
            'active_age_group'  => $this->ActiveAgeGroup() ? $this->ActiveAgeGroup()->first()  : null ,
            'active_subjects_from_active_age_group'  =>  $this->ActiveSubjectsFromActiveAgeGroup() ? $this->ActiveSubjectsFromActiveAgeGroup()->get() : []   ,

            'subscription_status' =>    $subscription_status ,
            'subscription' =>    $SubUserSubscription ,
        ];        
    }
}
